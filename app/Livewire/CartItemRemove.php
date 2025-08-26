<?php

namespace App\Livewire;

use App\Contract\CartServiceInterface;
use App\Data\ProductData;
use Livewire\Component;

class CartItemRemove extends Component
{
    public string $sku;

    public function mount(ProductData $product)
    {
        $this->sku = $product->sku;
    }

    public function remove(CartServiceInterface $cart)
    {
        $cart->remove($this->sku);

        session()->flash('success', 'Product has been removed from your cart');

        $this->dispatch('cart-update');

        return redirect()->route('cart');
    }

    public function render()
    {
        return view('livewire.cart-item-remove');
    }
}
