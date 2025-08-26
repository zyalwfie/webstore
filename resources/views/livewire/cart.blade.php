<div>
    <div class="container mx-auto w-full max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid gap-10 md:grid-cols-10">
            <div class="md:col-span-7">
                <h1 class="mb-5 text-2xl font-light">Shopping Bag</h1>
                <div class="grid gap-5">
                    @forelse ($items as $item)
                        <div class="flex gap-5 border-b border-gray-200 pb-5">
                            <div class="relative h-40 w-40 overflow-hidden rounded-xl">
                                <img class="object-coversize-full" src="{{ $item->product()->imgUrl }}"
                                    alt="{{ $item->sku }}">
                            </div>
                            <div class="flex items-center">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                                        {{ $item->product()->name }}
                                    </h3>
                                    <h2 class="text-sm text-gray-800">
                                        {{ $item->product()->short_desc }}
                                    </h2>
                                    <div class="flex flex-col">

                                        <div class="my-5 flex items-start gap-2">
                                            @livewire('add-to-cart', ['product' => $item->product()])
                                            @livewire('cart-item-remove', ['product' => $item->product()])
                                        </div>

                                        <p class="text-xl font-semibold text-black dark:text-black">
                                            {{ $item->product()->formattedPrice }}
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div>
                            No product in your shopping bag
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="md:col-span-3">
                <h1 class="mb-5 text-2xl font-light">Order Summary</h1>
                <div class="grid gap-5">
                    <!-- List Group -->
                    <ul class="mt-3 flex flex-col">
                        <li
                            class="-mt-px inline-flex items-center gap-x-2 border border-gray-200 px-4 py-3 text-sm text-gray-800 first:mt-0 first:rounded-t-lg last:rounded-b-lg dark:border-neutral-700 dark:text-neutral-200">
                            <div class="flex w-full items-center justify-between">
                                <span>Sub Total</span>
                                <span>{{ $sub_total }}</span>
                            </div>
                        </li>
                        <li
                            class="-mt-px inline-flex items-center gap-x-2 border border-gray-200 px-4 py-3 text-sm text-gray-800 first:mt-0 first:rounded-t-lg last:rounded-b-lg dark:border-neutral-700 dark:text-neutral-200">
                            <div class="flex w-full items-center justify-between">
                                <span>Shipping</span>
                                <span>—</span>
                            </div>
                        </li>
                        <li
                            class="-mt-px inline-flex items-center gap-x-2 border border-gray-200 px-4 py-3 text-sm font-semibold text-gray-800 first:mt-0 first:rounded-t-lg last:rounded-b-lg dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-200">
                            <div class="flex w-full items-center justify-between">
                                <span>Total</span>
                                <span>{{ $total }}</span>
                            </div>
                        </li>
                    </ul>
                    <!-- End List Group -->
                    <button type="button" wire:click='checkout' wire:loading.attr='disabled'
                        class="focus:outline-hidden inline-flex w-full cursor-pointer items-center justify-center gap-x-2 rounded-lg border border-transparent bg-blue-600 px-3 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                        <span wire:loading.remove>Checkout now</span>
                        <span wire:loading
                            class="border-3 inline-block size-4 animate-spin rounded-full border-current border-t-transparent text-white"
                            role="status" aria-label="loading"></span>
                        <span wire:loading>Loading</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
