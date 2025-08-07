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
use Livewire\WithPagination;

#[Title('Webstore | Product Catalog')]
class ProductCatalog extends Component
{
    use WithPagination;

    public $queryString = [
        'select_collections' => ['except' => []],
        'sort_by' => ['except' => 'newest'],
        'search' => ['except' => []]
    ];

    public array $select_collections = [];

    public string $search = '';

    public string $sort_by = 'newest';

    public function applyFilters()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->select_collections = [];
        $this->search = '';
        $this->sort_by = 'newest';
        $this->resetPage();
    }

    #[Computed()]
    public function getTags()
    {
        return Product::withAllTags(['name'])->get();
    }

    #[Computed()]
    public function products()
    {
        $query = Product::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if (!empty($this->select_collections)) {
            $query->whereHas('tags', function ($query) {
                $query->whereIn('id', $this->select_collections);
            });
        }

        switch ($this->sort_by) {
            case 'latest':
                $query->oldest();
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $products = ProductData::collect($query->paginate(3));

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
