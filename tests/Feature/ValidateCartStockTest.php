<?php

use App\Actions\ValidateCartStock;
use App\Contract\CartServiceInterface;
use App\Data\CartData;
use App\Data\CartItemData;
use App\Models\Product;
use Illuminate\Validation\ValidationException;
use Spatie\LaravelData\DataCollection;

function fakeCartWith(array $items): CartServiceInterface
{
    $cart = new CartData(
        new DataCollection(
            CartItemData::class,
            array_map(fn ($i) => new CartItemData(
                sku: $i['sku'],
                quantity: $i['quantity'],
                price: 10_000,
                weight: 500,
            ), $items)
        )
    );

    return new class($cart) implements CartServiceInterface
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
    };
}

function bindCart(CartServiceInterface $cart): void
{
    app()->instance(CartServiceInterface::class, $cart);
}

it('passes silently when every product has enough stock', function () {
    Product::create(['name' => 'A', 'sku' => 'SKU-A', 'slug' => 'a', 'stock' => 10, 'price' => 10_000, 'weight' => 500]);
    bindCart(fakeCartWith([['sku' => 'SKU-A', 'quantity' => 3]]));

    ValidateCartStock::run();

    expect(true)->toBeTrue(); // reached here without throwing
});

it('throws when a product has insufficient stock', function () {
    Product::create(['name' => 'A', 'sku' => 'SKU-A', 'slug' => 'a', 'stock' => 2, 'price' => 10_000, 'weight' => 500]);
    bindCart(fakeCartWith([['sku' => 'SKU-A', 'quantity' => 5]]));

    ValidateCartStock::run();
})->throws(ValidationException::class);

it('does not crash and reports when a cart item references a deleted product', function () {
    // No product row for SKU-GONE — the old code crashed hydrating ProductData.
    bindCart(fakeCartWith([['sku' => 'SKU-GONE', 'quantity' => 1]]));

    expect(fn () => ValidateCartStock::run())->toThrow(ValidationException::class);
});
