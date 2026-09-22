<?php

use App\Contract\CartServiceInterface;
use App\Data\CartData;
use App\Data\CartItemData;
use App\Data\RegionData;
use App\Livewire\Checkout;
use App\Models\Product;
use App\Services\RegionQueryService;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Spatie\LaravelData\DataCollection;

function bindCheckoutCart(): void
{
    // A single in-stock item so the mount() stock gate + quantity check pass.
    Product::create(['name' => 'Widget', 'sku' => 'SKU-1', 'slug' => 'widget', 'stock' => 10, 'price' => 50_000, 'weight' => 500]);

    $cart = new CartData(new DataCollection(CartItemData::class, [
        new CartItemData(sku: 'SKU-1', quantity: 1, price: 50_000, weight: 500),
    ]));

    app()->instance(CartServiceInterface::class, new class($cart) implements CartServiceInterface
    {
        public function __construct(private CartData $cart) {}

        public function all(): CartData
        {
            return $this->cart;
        }

        public function addOrdUpdate(CartItemData $item): void {}

        public function remove(string $sku): void {}

        public function getItemBySku(string $sku): ?CartItemData
        {
            return null;
        }

        public function clear(): void {}
    });
}

function bindFakeRegions(): void
{
    app()->instance(RegionQueryService::class, new class extends RegionQueryService
    {
        public function searchRegionByCode(string $code): ?RegionData
        {
            return new RegionData(
                code: $code,
                province: 'Prov',
                city: 'City',
                district: 'Dist',
                sub_district: 'SubDist',
                postal_code: '40111',
            );
        }

        public function SearchRegionByName(string $keyword, int $limit = 5): DataCollection
        {
            return new DataCollection(RegionData::class, []);
        }
    });
}

beforeEach(function () {
    bindCheckoutCart();
    bindFakeRegions();
});

it('renders offline couriers immediately once a destination is chosen', function () {
    Http::fake(); // API not called during the initial render

    Livewire::test(Checkout::class)
        ->set('data.destination_region_code', 'DEST-1')
        ->assertViewHas('cart')
        ->assertSee('Internal Courier'); // offline driver label, no HTTP needed

    Http::assertNothingSent();
});

it('loads external couriers via the deferred loadApiShipping action', function () {
    Http::fake(['sandbox.apikurir.id/*' => Http::response([
        'data' => [[[
            'price' => 21_000, 'weight' => 1000,
            'minDuration' => 1, 'maxDuration' => 2, 'durationType' => 'day',
            'logoUrl' => null,
        ]]],
    ], 200)]);

    Livewire::test(Checkout::class)
        ->set('data.destination_region_code', 'DEST-1')
        ->call('loadApiShipping')
        ->assertSet('api_shipping_loaded', true)
        ->assertSet('api_shipping_failed', false);
});

it('degrades gracefully and flags failure when the external api times out', function () {
    Http::fake(function () {
        throw new ConnectException('timed out', new GuzzleRequest('POST', 'https://sandbox.apikurir.id/x'));
    });

    Livewire::test(Checkout::class)
        ->set('data.destination_region_code', 'DEST-1')
        ->call('loadApiShipping')
        ->assertSet('api_shipping_loaded', true)
        ->assertSet('api_shipping_failed', true)
        ->assertSee('Kurir eksternal sedang tidak tersedia');
});

it('resets shipping state when the destination changes', function () {
    Http::fake();

    Livewire::test(Checkout::class)
        ->set('data.destination_region_code', 'DEST-1')
        ->set('api_shipping_loaded', true)
        ->set('data.shipping_hash', 'stale-hash')
        ->set('region_selector.region_selected', 'DEST-2')
        ->assertSet('api_shipping_loaded', false)
        ->assertSet('data.shipping_hash', null);
});
