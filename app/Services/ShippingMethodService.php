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
    protected array $drivers;

    public function __construct()
    {
        $this->drivers = [
            new OfflineShippingDriver(),
            new APIKurirShippingDriver()
        ];
    }

    public function getDriver(ShippingServiceData $service): ShippingDriverInterface
    {
        return collect($this->drivers)
            ->first(fn(ShippingDriverInterface $shipping_driver) => $shipping_driver->driver === $service->driver);
    }

    /** @return DataCollection<ShippingServiceData> */
    public function getShippingServices(): DataCollection
    {
        return collect($this->drivers)
            ->flatMap(fn(ShippingDriverInterface $driver) => $driver->getServices()->toCollection())
            ->pipe(fn($items) => ShippingServiceData::collect($items, DataCollection::class));
    }

    /** @return DataCollection<ShippingData> */
    public function getShippingMethods(
        RegionData $origin,
        RegionData $destination,
        CartData $cart
    ): DataCollection {
        $cache_key = "shipping_methods:{$origin->code}:{$destination->code}:{$cart->total_weight}";

        return Cache::remember($cache_key, now()->addMinutes(15), function () use ($origin, $destination, $cart) {
            $services = $this->getShippingServices()->toCollection();

            // Offline drivers are instant — run synchronously
            $offlineResults = $services
                ->filter(fn(ShippingServiceData $s) => $s->driver !== 'apikurir')
                ->map(function (ShippingServiceData $s) use ($origin, $destination, $cart) {
                    $data = $this->getDriver($s)->getRate($origin, $destination, $cart, $s);
                    if ($data) {
                        Cache::put("shipping_data:{$data->hash}", $data, now()->addMinutes(15));
                    }
                    return $data;
                })
                ->filter();

            // API Kurir services — fire all requests concurrently via Http::pool()
            $apiServices = $services
                ->filter(fn(ShippingServiceData $s) => $s->driver === 'apikurir')
                ->values();

            $apiResults = collect();

            if ($apiServices->isNotEmpty()) {
                $responses = Http::pool(function (Pool $pool) use ($apiServices, $origin, $destination, $cart) {
                    foreach ($apiServices as $idx => $service) {
                        $pool->as((string) $idx)
                            ->timeout(15)
                            ->withBasicAuth(
                                config('shipping.api_kurir_username'),
                                config('shipping.api_kurir_password'),
                            )
                            ->post('https://sandbox.apikurir.id/shipments/v1/open-api/rates', [
                                'isUseInsurance' => true,
                                'isPickup'       => true,
                                'isCod'          => false,
                                'weight'         => $cart->total_weight,
                                'packagePrice'   => $cart->total,
                                'origin'         => ['postalCode' => $origin->postal_code],
                                'destination'    => ['postalCode' => $destination->postal_code],
                                'logistics'      => [$service->courier],
                                'services'       => [$service->service],
                            ]);
                    }
                });

                foreach ($apiServices as $idx => $service) {
                    $response = $responses[(string) $idx];

                    if ($response instanceof ConnectionException) {
                        continue;
                    }

                    if ($response->failed()) {
                        continue;
                    }

                    $raw = $response->collect('data')->flatten(1)->values()->first();
                    if (empty($raw)) {
                        continue;
                    }

                    $est = data_get($raw, 'minDuration') . ' - ' . data_get($raw, 'maxDuration') . ' - ' . data_get($raw, 'durationType');
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
                    $apiResults->push($shippingData);
                }
            }

            return ShippingData::collect($offlineResults->merge($apiResults), DataCollection::class);
        });
    }

    public function getShippingMethod(string $hash): ?ShippingData
    {
        return Cache::get("shipping_data:{$hash}");
    }
}
