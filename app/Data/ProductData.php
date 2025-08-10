<?php

declare(strict_types=1);

namespace App\Data;

use App\Models\Product;
use Spatie\LaravelData\Data;
use Illuminate\Support\Number;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Attributes\Computed;

class ProductData extends Data
{
    #[Computed]
    public string $formattedPrice;

    public function __construct(
        public string $name,
        public string $short_desc,
        public string $sku,
        public string $slug,
        public string|Optional|null $description,
        public int $stock,
        public float $price,
        public int $weight,
        public string $imgUrl,
        public Optional|array $gallery = new Optional()
    ) {
        $this->formattedPrice = Number::currency($price);
    }

    public static function fromModel(Product $product, bool $withGallery = false): self
    {
        return new self(
            $product->name,
            $product->tags()->where('type', 'collection')->pluck('name')->implode(', '),
            $product->sku,
            $product->slug,
            $product->description,
            $product->stock,
            floatval($product->price),
            $product->weight,
            $product->getFirstMediaUrl('cover'),
            gallery: $withGallery ? $product->getMedia('gallery')->map(fn($record) => $record->getUrl())->toArray() : new Optional()
        );
    }
}
