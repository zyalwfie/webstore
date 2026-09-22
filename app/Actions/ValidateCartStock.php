<?php

namespace App\Actions;

use App\Contract\CartServiceInterface;
use App\Models\Product;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;

class ValidateCartStock
{
    use AsAction;

    public function __construct(
        public CartServiceInterface $cart
    ) {}

    public function handle()
    {
        $insufficient = [];

        foreach ($this->cart->all()->items as $item) {
            // Query the product directly: a cart item may reference a product
            // that was deleted, and CartItemData::product() would throw when
            // hydrating a ProductData from a null model.
            $product = Product::where('sku', $item->sku)->first();

            if (! $product || $product->stock < $item->quantity) {
                $insufficient[] = [
                    'sku' => $item->sku,
                    'name' => $product->name ?? 'Unknown',
                    'requested' => $item->quantity,
                    'available' => $product->stock ?? 0,
                ];
            }
        }

        if ($insufficient) {
            throw ValidationException::withMessages([
                'cart' => 'Some product is insufficient stock',
                'details' => $insufficient,
            ]);
        }
    }
}
