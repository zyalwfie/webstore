<?php

namespace App\Livewire;

use App\Data\ProductData;
use App\Models\Product;
use App\Models\Tag;
use Livewire\Attributes\Title;
use Livewire\Component;

class HomePage extends Component
{
    #[Title('Webstore — Belajar Ngoding dari Praktisi')]
    public function render()
    {
        $featured_products = ProductData::collect(
            Product::query()->inRandomOrder()->limit(3)->get()
        );
        $latest_products = ProductData::collect(
            Product::query()->latest()->limit(3)->get()
        );

        $collections = Tag::query()
            ->withType('collection')
            ->withCount('products')
            ->orderByDesc('products_count')
            ->having('products_count', '>', 0)
            ->limit(6)
            ->get();

        return view('livewire.home-page', compact('featured_products', 'latest_products', 'collections'));
    }
}
