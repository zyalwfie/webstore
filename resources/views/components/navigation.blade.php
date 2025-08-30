<!-- ========== HEADER ========== -->
<header
    class="z-50 flex w-full flex-wrap border-b border-gray-200 bg-white md:flex-nowrap md:justify-start dark:border-neutral-700 dark:bg-neutral-800">
    <nav
        class="relative mx-auto w-full max-w-[85rem] px-4 py-2 sm:px-6 md:flex md:items-center md:justify-between md:gap-3 lg:px-8 dark:bg-neutral-900">
        <!-- Logo w/ Collapse Button -->
        <div class="flex items-center justify-between">
            <a class="focus:outline-hidden flex-none text-xl font-semibold text-black focus:opacity-80 dark:text-white"
                href="{{ url('/') }}" aria-label="Brand">{{ config('app.name') }}</a>

            <!-- Collapse Button -->
            <div class="md:hidden">
                <button type="button"
                    class="hs-collapse-toggle focus:outline-hidden relative flex size-9 items-center justify-center rounded-lg border border-gray-200 text-sm font-semibold text-gray-800 hover:bg-gray-100 focus:bg-gray-100 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                    id="hs-header-classic-collapse" aria-expanded="false" aria-controls="hs-header-classic"
                    aria-label="Toggle navigation" data-hs-collapse="#hs-header-classic">
                    <svg class="hs-collapse-open:hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" x2="21" y1="6" y2="6" />
                        <line x1="3" x2="21" y1="12" y2="12" />
                        <line x1="3" x2="21" y1="18" y2="18" />
                    </svg>
                    <svg class="hs-collapse-open:block hidden size-4 shrink-0" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                    <span class="sr-only">Toggle navigation</span>
                </button>
            </div>
            <!-- End Collapse Button -->
        </div>
        <!-- End Logo w/ Collapse Button -->

        <!-- Collapse -->
        <div id="hs-header-classic"
            class="hs-collapse hidden grow basis-full overflow-hidden transition-all duration-300 md:block"
            aria-labelledby="hs-header-classic-collapse">
            <div
                class="max-h-[75vh] overflow-hidden overflow-y-auto [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 [&::-webkit-scrollbar-track]:bg-gray-100 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 [&::-webkit-scrollbar]:w-2">
                <div class="flex flex-col gap-0.5 py-2 md:flex-row md:items-center md:justify-end md:gap-1 md:py-0">
                    <a class="focus:outline-hidden flex items-center p-2 text-sm {{ Route::is('home') ? 'text-blue-600 focus:text-blue-600 dark:text-blue-500 dark:focus:text-blue-500' : 'text-gray-800 hover:text-gray-500 focus:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-500 dark:focus:text-neutral-500' }}"
                        href="#" aria-current="page">
                        <svg class="me-3 block size-4 shrink-0 md:me-2 md:hidden" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                            <path
                                d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        </svg>
                        Home
                    </a>

                    <a class="focus:outline-hidden flex items-center p-2 text-sm {{ (Route::is('product-catalog') || Route::is('product') || Route::is('cart')) || (Route::is('checkout')) ? 'text-blue-600 focus:text-blue-600 dark:text-blue-500 dark:focus:text-blue-500' : 'text-gray-800 hover:text-gray-500 focus:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-500 dark:focus:text-neutral-500' }}"
                        href="{{ route('product-catalog') }}">
                        <svg class="me-3 block size-4 shrink-0 md:me-2 md:hidden" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shirt">
                            <path
                                d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z" />
                        </svg>
                        Collection
                    </a>

                    @livewire('cart_count')
                </div>
            </div>
        </div>
        <!-- End Collapse -->
    </nav>
</header>
<!-- ========== END HEADER ========== -->
