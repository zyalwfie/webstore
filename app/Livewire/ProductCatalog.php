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

    public function mount()
    {
        $this->validate();
    }

    public function applyFilters()
    {
        $this->validate();
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->select_collections = [];
        $this->search = '';
        $this->sort_by = 'newest';
        $this->resetErrorBag();
        $this->resetPage();
    }

    protected function rules()
    {
        return [
            'select_collections' => 'array',
            'select_collections.*' => 'integer|exists:tags,id',
            'search' => 'nullable|string|min:3|max:30',
            'sort_by' => 'in:newest,latest,price_asc,price_desc'
        ];
    }

    public function validationAttributes()
    {
        return [
            'select_collections' => 'Collection',
            'sort_by' => 'Sort by'
        ];
    }

    #[Computed()]
    public function getTags()
    {
        return Product::withAllTags(['name'])->get();
    }

    public function render()
    {
        $collections = ProductCollectionData::collect([]);
        $products = ProductData::collect([]);

        if ($this->getErrorBag()->isNotEmpty()) {
            return view('livewire.product-catalog', compact('collections', 'products'));
        }

        $collectionResult = Tag::query()->withType('collection')->withCount('products')->get(); // Query
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

        $collections = ProductCollectionData::collect($collectionResult);
        $products = ProductData::collect($query->paginate(3));

        return view('livewire.product-catalog', compact('collections', 'products'));
    }
}
