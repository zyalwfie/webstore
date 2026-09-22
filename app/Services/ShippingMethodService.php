<?php

declare(strict_types=1);

namespace App\Services;

use App\Contract\ShippingDriverInterface;
use App\Data\CartData;
use App\Data\RegionData;
use App\Data\ShippingData;
use App\Data\ShippingServiceData;
use App\Drivers\Shipping\APIKurirShippingDriver;
use App\Drivers\Shipping\OfflineShippingDriver;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Spatie\LaravelData\DataCollection;

class ShippingMethodService
{
    /** Per-request timeout for each API Kurir rate call (seconds). */
    private const API_TIMEOUT = 8;

    /** How long a failed/timed-out API lookup stays cached (seconds). */
    private const API_FAILURE_TTL = 60;

    protected array $drivers;

    public function __construct()
    {
        $this->drivers = [
            new OfflineShippingDriver,
            new APIKurirShippingDriver,
        ];
    }

    public function getDriver(ShippingServiceData $service): ShippingDriverInterface
    {
        return collect($this->drivers)
            ->first(fn (ShippingDriverInterface $shipping_driver) => $shipping_driver->driver === $service->driver);
    }

    /** @return DataCollection<ShippingServiceData> */
    public function getShippingServices(): DataCollection
    {
        return collect($this->drivers)
            ->flatMap(fn (ShippingDriverInterface $driver) => $driver->getServices()->toCollection())
            ->pipe(fn ($items) => ShippingServiceData::collect($items, DataCollection::class));
    }

    /**
     * Offline shipping methods are computed locally (no network) so they are
     * always instant and safe to resolve during a Livewire render.
     *
     * @return DataCollection<ShippingData>
     */
    public function getOfflineShippingMethods(
        RegionData $origin,
        RegionData $destination,
        CartData $cart
    ): DataCollection {
        $cache_key = "shipping_methods:offline:{$origin->code}:{$destination->code}:{$cart->total_weight}";

        return Cache::remember($cache_key, now()->addMinutes(15), function () use ($origin, $destination, $cart) {
            $results = $this->getShippingServices()->toCollection()
                ->filter(fn (ShippingServiceData $s) => $s->driver !== 'apikurir')
                ->map(function (ShippingServiceData $s) use ($origin, $destination, $cart) {
                    $data = $this->getDriver($s)->getRate($origin, $destination, $cart, $s);
                    if ($data) {
                        Cache::put("shipping_data:{$data->hash}", $data, now()->addMinutes(15));
                    }

                    return $data;
                })
                ->filter();

            return ShippingData::collect($results, DataCollection::class);
        });
    }

    /**
     * API Kurir methods require slow external HTTP calls, so this MUST NOT run
     * inside a Livewire render path — call it from a deferred action instead.
     *
     * The returned "failed" flag lets the UI degrade gracefully: a transient
     * outage/timeout is cached only briefly so couriers reappear once the
     * upstream recovers, instead of being hidden for the full success TTL.
     *
     * @return array{methods: DataCollection<ShippingData>, failed: bool}
     */
    public function getApiShippingMethods(
        RegionData $origin,
        RegionData $destination,
        CartData $cart
    ): array {
        $cache_key = "shipping_methods:api:{$origin->code}:{$destination->code}:{$cart->total_weight}";

        if (($cached = Cache::get($cache_key)) !== null) {
            return [
                'methods' => ShippingData::collect($cached['hashes'], DataCollection::class),
                'failed' => $cached['failed'],
            ];
        }

        $apiServices = $this->getShippingServices()->toCollection()
            ->filter(fn (ShippingServiceData $s) => $s->driver === 'apikurir')
            ->values();

        $results = collect();
        $failed = false;

        if ($apiServices->isNotEmpty()) {
            try {
                $responses = Http::pool(function (Pool $pool) use ($apiServices, $origin, $destination, $cart) {
                    foreach ($apiServices as $idx => $service) {
                        $pool->as((string) $idx)
                            ->timeout(self::API_TIMEOUT)
                            ->withBasicAuth(
                                config('shipping.api_kurir_username'),
                                config('shipping.api_kurir_password'),
                            )
                            ->post('https://sandbox.apikurir.id/shipments/v1/open-api/rates', [
                                'isUseInsurance' => true,
                                'isPickup' => true,
                                'isCod' => false,
                                'weight' => $cart->total_weight,
                                'packagePrice' => $cart->total,
                                'origin' => ['postalCode' => $origin->postal_code],
                                'destination' => ['postalCode' => $destination->postal_code],
                                'logistics' => [$service->courier],
                                'services' => [$service->service],
                            ]);
                    }
                });
            } catch (ConnectionException $e) {
                $responses = [];
                $failed = true;
            }

            foreach ($apiServices as $idx => $service) {
                $response = $responses[(string) $idx] ?? null;

                if ($response === null || $response instanceof ConnectionException) {
                    $failed = true;

                    continue;
                }

                if ($response->failed()) {
                    $failed = true;

                    continue;
                }

                $raw = $response->collect('data')->flatten(1)->values()->first();
                if (empty($raw)) {
                    continue;
                }

                $est = data_get($raw, 'minDuration').' - '.data_get($raw, 'maxDuration').' - '.data_get($raw, 'durationType');
                $shippingData = new ShippingData(
                    'apikurir',
                    $service->courier,
                    $service->service,
                    $est,
                    data_get($raw, 'price'),
                    data_get($raw, 'weight'),
                    $origin,
                    $destination,
                    data_get($raw, 'logoUrl'),
                );

                Cache::put("shipping_data:{$shippingData->hash}", $shippingData, now()->addMinutes(15));
                $results->push($shippingData);
            }
        }

        // Cache success for 15 min, but failures only briefly so a transient
        // upstream outage does not hide couriers for the full window.
        $ttl = $failed ? now()->addSeconds(self::API_FAILURE_TTL) : now()->addMinutes(15);
        Cache::put($cache_key, [
            'hashes' => $results->all(),
            'failed' => $failed,
        ], $ttl);

        return [
            'methods' => ShippingData::collect($results, DataCollection::class),
            'failed' => $failed,
        ];
    }

    public function getShippingMethod(string $hash): ?ShippingData
    {
        return Cache::get("shipping_data:{$hash}");
    }
}
