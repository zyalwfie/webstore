<?php
declare(strict_types=1);

namespace App\Livewire;

use App\Data\ProductData;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

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
        $result = Product::latest()->paginate(5); // Query
        $products = ProductData::collect($result);
        return $products;
    }
}
