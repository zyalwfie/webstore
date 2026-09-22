<x-store-layout title="Homepage">
    <div class="container mx-auto max-w-[85rem] w-full">
        <div class="mt-10">
            <x-product-sections title="Feature Product" :url="route('katalog')" />
            <x-featured-icon />
            <x-product-sections title="Latest Products" :url="route('katalog')" />
        </div>
    </div>
</x-store-layout>
