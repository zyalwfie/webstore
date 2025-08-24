<?php

declare(strict_types=1);

namespace App\Service;

use App\Contract\CartServiceInterface;
use App\Data\CartData;
use App\Data\CartItemData;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Spatie\LaravelData\DataCollection;

class SessionCartService implements CartServiceInterface
{
    protected $session_key = 'cart';

    protected function load(): DataCollection
    {
        $raw = Session::get($this->session_key, []);

        return new DataCollection(CartItemData::class, $raw);
    }

    /** @param Collection<int, CartItemData> $items */
    protected function save(Collection $items): void
    {
        Session::put($this->session_key, $items->values()->all());
    }

    public function addOrdUpdate(CartItemData $item): void
    {
        // * 1. Get data from session
        $collection = $this->load()->toCollection();
        $updated = false;

        // * 2. Mapping
        $cart = $collection->map(function (CartItemData $i) use ($item, &$updated) {
            if ($i->sku == $item->sku) {
                $updated = true;
                return $item;
            }

            return $i;
        })->values()->collect();

        if (!$updated) {
            $cart->push($item);
        }

        // * 3. Save
        $this->save($cart);
    }

    public function remove(string $sku): void
    {
        $cart = $this->load()->toCollection()
            ->reject(fn(CartItemData $i) => $i->sku === $sku)
            ->values()
            ->collect();

        $this->save($cart);
    }

    public function getItemBySku(string $sku): ?CartItemData
    {
        return $this->load()->toCollection()
            ->first(fn(CartItemData $i) => $i->sku === $sku);
    }

    public function all(): CartData
    {
        return new CartData($this->load());
    }
}
