<a class="flex flex-col bg-white group rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70"
    href="{{ route('product') }}">
    <img class="object-cover rounded-md aspect-square" src="{{ $product->imgUrl }}" alt="Product Name">
    <div class="py-5">
        <h3 class="text-lg font-bold text-gray-800 dark:text-white">
            {{ $product->name }}
        </h3>
        <span class="text-sm capitalize text-gray-500">
            {{ $product->tags }}
        </span>
        <p class="mt-1 font-semibold text-black dark:text-black">
            {{ $product->formattedPrice }}
        </p>
    </div>
</a>
