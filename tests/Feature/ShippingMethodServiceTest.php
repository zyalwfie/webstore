<?php

use App\Data\CartData;
use App\Data\CartItemData;
use App\Data\RegionData;
use App\Services\ShippingMethodService;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Spatie\LaravelData\DataCollection;

const RATES_URL = 'https://sandbox.apikurir.id/*';

function fakeRegion(string $code, string $postal): RegionData
{
    return new RegionData(
        code: $code,
        province: 'Prov',
        city: 'City',
        district: 'Dist',
        sub_district: 'SubDist',
        postal_code: $postal,
    );
}

function fakeCart(): CartData
{
    return new CartData(
        new DataCollection(CartItemData::class, [
            new CartItemData(sku: 'SKU-1', quantity: 2, price: 50_000, weight: 500),
        ])
    );
}

function apiRatePayload(int $price): array
{
    // Mirrors the upstream shape: data is grouped so the service parser
    // (collect('data')->flatten(1)->first()) resolves the rate object.
    return [
        'data' => [
            [
                [
                    'price' => $price,
                    'weight' => 1000,
                    'minDuration' => 1,
                    'maxDuration' => 2,
                    'durationType' => 'day',
                    'logoUrl' => 'https://example.test/logo.png',
                ],
            ],
        ],
    ];
}

beforeEach(function () {
    $this->origin = fakeRegion('ORIGIN', '40111');
    $this->destination = fakeRegion('DEST', '10110');
    $this->cart = fakeCart();
    $this->service = app(ShippingMethodService::class);
});

it('returns offline methods instantly without any HTTP call', function () {
    Http::fake(); // any HTTP call would be recorded; we assert none happen

    $methods = $this->service->getOfflineShippingMethods($this->origin, $this->destination, $this->cart);

    expect($methods)->toBeInstanceOf(DataCollection::class)
        ->and($methods->toCollection())->toHaveCount(2)
        ->and($methods->toCollection()->pluck('driver')->unique()->all())->toBe(['offline']);

    Http::assertNothingSent();
});

it('returns api methods and does not flag failure when upstream responds', function () {
    Http::fake([RATES_URL => Http::response(apiRatePayload(23_000), 200)]);

    $result = $this->service->getApiShippingMethods($this->origin, $this->destination, $this->cart);

    expect($result['failed'])->toBeFalse()
        ->and($result['methods']->toCollection())->not->toBeEmpty()
        ->and($result['methods']->toCollection()->first()->driver)->toBe('apikurir');
});

it('flags failure and returns no methods when the api connection times out', function () {
    // A real pool timeout surfaces as a Guzzle ConnectException, which the
    // framework converts into the ConnectionException value the service guards.
    Http::fake(function () {
        throw new ConnectException(
            'cURL error 28: Operation timed out',
            new GuzzleRequest('POST', 'https://sandbox.apikurir.id/shipments/v1/open-api/rates')
        );
    });

    $result = $this->service->getApiShippingMethods($this->origin, $this->destination, $this->cart);

    expect($result['failed'])->toBeTrue()
        ->and($result['methods']->toCollection())->toBeEmpty();
});

it('flags failure and returns no methods on an upstream error response', function () {
    Http::fake([RATES_URL => Http::response(['message' => 'upstream down'], 500)]);

    $result = $this->service->getApiShippingMethods($this->origin, $this->destination, $this->cart);

    expect($result['failed'])->toBeTrue()
        ->and($result['methods']->toCollection())->toBeEmpty();
});

it('caches a failure only briefly so couriers can reappear', function () {
    Http::fake([RATES_URL => Http::response(['message' => 'down'], 500)]);

    $this->service->getApiShippingMethods($this->origin, $this->destination, $this->cart);

    $cache_key = "shipping_methods:api:{$this->origin->code}:{$this->destination->code}:{$this->cart->total_weight}";

    // A negative result is cached (so we don't hammer a broken upstream) but
    // flagged failed, and only for the short failure TTL — not 15 minutes.
    expect(Cache::has($cache_key))->toBeTrue()
        ->and(Cache::get($cache_key)['failed'])->toBeTrue();
});

it('exposes selectable rates by hash after a successful lookup', function () {
    Http::fake([RATES_URL => Http::response(apiRatePayload(23_000), 200)]);

    $result = $this->service->getApiShippingMethods($this->origin, $this->destination, $this->cart);
    $hash = $result['methods']->toCollection()->first()->hash;

    expect($this->service->getShippingMethod($hash))->not->toBeNull()
        ->and($this->service->getShippingMethod($hash)->cost)->toBe(23_000.0);
});
