<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Data\ProductCollectionData;
use App\Models\Tag;
use App\Models\Product;
use Livewire\Component;
use App\Data\ProductData;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;

#[Title('Webstore | Product Catalog')]
class ProductCatalog extends Component
{
    #[Computed()]
    public function getTags()
    {
        return Product::withAllTags(['name'])->get();
    }

    #[Computed()]
    public function products()
    {
        $dataResult = Product::latest()->paginate(5); // Query
        $products = ProductData::collect($dataResult);

        return $products;
    }

    #[Computed()]
    public function collections()
    {
        $collectionResult = Tag::query()->withType('collection')->withCount('products')->get(); // Query
        $collections = ProductCollectionData::collect($collectionResult);

        return $collections;
    }
}
