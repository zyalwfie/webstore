<!-- ========== FOOTER ========== -->
<footer class="w-full mt-auto border-t border-gray-200 bg-white dark:border-neutral-800 dark:bg-neutral-950">
    <div class="mt-auto w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 lg:pt-16 mx-auto">
        <!-- Grid -->
        <div class="grid grid-cols-2 gap-8 md:grid-cols-4 lg:grid-cols-5">
            <!-- Brand -->
            <div class="col-span-full lg:col-span-2">
                <a class="flex-none text-xl font-semibold text-gray-800 dark:text-white focus:outline-hidden focus:opacity-80" href="{{ url('/') }}" aria-label="{{ config('app.name') }}">{{ config('app.name') }}</a>
                <p class="mt-4 max-w-sm text-sm leading-relaxed text-gray-600 dark:text-neutral-400">
                    Platform belajar ngoding untuk developer Indonesia. Kami menyediakan kelas video,
                    ebook, dan proyek studi kasus yang dibuat langsung oleh praktisi — supaya kamu bisa
                    belajar hal yang benar-benar dipakai di dunia kerja.
                </p>

                <!-- Social -->
                <div class="mt-6 flex gap-2">
                    <a class="inline-flex size-9 items-center justify-center rounded-lg border border-gray-200 text-gray-600 transition hover:bg-gray-100 dark:border-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-800" href="#" aria-label="Instagram">
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                    </a>
                    <a class="inline-flex size-9 items-center justify-center rounded-lg border border-gray-200 text-gray-600 transition hover:bg-gray-100 dark:border-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-800" href="#" aria-label="YouTube">
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/><path d="m10 15 5-3-5-3z"/></svg>
                    </a>
                    <a class="inline-flex size-9 items-center justify-center rounded-lg border border-gray-200 text-gray-600 transition hover:bg-gray-100 dark:border-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-800" href="#" aria-label="X">
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <a class="inline-flex size-9 items-center justify-center rounded-lg border border-gray-200 text-gray-600 transition hover:bg-gray-100 dark:border-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-800" href="#" aria-label="GitHub">
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.4 5.4 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"/><path d="M9 18c-4.51 2-5-2-7-2"/></svg>
                    </a>
                </div>
            </div>
            <!-- End Brand -->

            <!-- Belanja -->
            <div>
                <h4 class="text-xs font-semibold uppercase tracking-wider text-gray-800 dark:text-neutral-100">Belanja</h4>
                <div class="mt-4 grid space-y-3 text-sm">
                    <p><a class="inline-flex text-gray-600 transition hover:text-gray-900 dark:text-neutral-400 dark:hover:text-neutral-200" href="{{ route('product-catalog') }}">Semua Katalog</a></p>
                    <p><a class="inline-flex text-gray-600 transition hover:text-gray-900 dark:text-neutral-400 dark:hover:text-neutral-200" href="{{ route('product-catalog', ['sort_by' => 'newest']) }}">Rilis Terbaru</a></p>
                    <p><a class="inline-flex text-gray-600 transition hover:text-gray-900 dark:text-neutral-400 dark:hover:text-neutral-200" href="{{ route('product-catalog', ['sort_by' => 'price_asc']) }}">Harga Terjangkau</a></p>
                    <p><a class="inline-flex text-gray-600 transition hover:text-gray-900 dark:text-neutral-400 dark:hover:text-neutral-200" href="{{ route('cart') }}">Keranjang</a></p>
                </div>
            </div>
            <!-- End Belanja -->

            <!-- Perusahaan -->
            <div>
                <h4 class="text-xs font-semibold uppercase tracking-wider text-gray-800 dark:text-neutral-100">Perusahaan</h4>
                <div class="mt-4 grid space-y-3 text-sm">
                    <p><a class="inline-flex text-gray-600 transition hover:text-gray-900 dark:text-neutral-400 dark:hover:text-neutral-200" href="{{ route('about') }}">Tentang Kami</a></p>
                    <p><a class="inline-flex text-gray-600 transition hover:text-gray-900 dark:text-neutral-400 dark:hover:text-neutral-200" href="{{ route('contact') }}">Kontak</a></p>
                    <p><a class="inline-flex text-gray-600 transition hover:text-gray-900 dark:text-neutral-400 dark:hover:text-neutral-200" href="{{ route('faq') }}">FAQ</a></p>
                </div>
            </div>
            <!-- End Perusahaan -->

            <!-- Bantuan -->
            <div>
                <h4 class="text-xs font-semibold uppercase tracking-wider text-gray-800 dark:text-neutral-100">Bantuan</h4>
                <div class="mt-4 grid space-y-3 text-sm">
                    <p><a class="inline-flex text-gray-600 transition hover:text-gray-900 dark:text-neutral-400 dark:hover:text-neutral-200" href="{{ route('page', 'syarat-ketentuan') }}">Syarat &amp; Ketentuan</a></p>
                    <p><a class="inline-flex text-gray-600 transition hover:text-gray-900 dark:text-neutral-400 dark:hover:text-neutral-200" href="{{ route('page', 'kebijakan-privasi') }}">Kebijakan Privasi</a></p>
                    <p><a class="inline-flex text-gray-600 transition hover:text-gray-900 dark:text-neutral-400 dark:hover:text-neutral-200" href="{{ route('page', 'pengiriman-retur') }}">Pengiriman &amp; Retur</a></p>
                </div>
            </div>
            <!-- End Bantuan -->
        </div>
        <!-- End Grid -->

        <!-- Payment & Shipping -->
        <div class="mt-10 grid gap-8 border-t border-gray-200 pt-8 sm:grid-cols-2 dark:border-neutral-800">
            <div>
                <h4 class="text-xs font-semibold uppercase tracking-wider text-gray-800 dark:text-neutral-100">Metode Pembayaran</h4>
                <div class="mt-3 flex flex-wrap gap-2">
                    <div class="flex items-center rounded-md border border-gray-200 bg-white px-2 dark:border-neutral-700"><img src="{{ asset('images/bank/bca-bank-central-asia.svg') }}" class="h-8 p-1.5" alt="BCA" /></div>
                    <div class="flex items-center rounded-md border border-gray-200 bg-white px-2 dark:border-neutral-700"><img src="{{ asset('images/bank/bank-mandiri.svg') }}" class="h-8 p-1.5" alt="Mandiri" /></div>
                    <div class="flex items-center rounded-md border border-gray-200 bg-white px-2 dark:border-neutral-700"><img src="{{ asset('images/bank/bank-negara-indonesia.svg') }}" class="h-8 p-1.5" alt="BNI" /></div>
                </div>
            </div>
            <div>
                <h4 class="text-xs font-semibold uppercase tracking-wider text-gray-800 dark:text-neutral-100">Metode Pengiriman</h4>
                <div class="mt-3 flex flex-wrap items-center gap-2">
                    <div class="flex h-8 items-center rounded-md border border-gray-200 bg-white px-2 dark:border-neutral-700"><img src="{{ asset('images/shipping/idexpress.webp') }}" class="max-h-6" alt="ID Express" /></div>
                    <div class="flex h-8 items-center rounded-md border border-gray-200 bg-white px-2 dark:border-neutral-700"><img src="{{ asset('images/shipping/jne.svg') }}" class="max-h-6" alt="JNE" /></div>
                    <div class="flex h-8 items-center rounded-md border border-gray-200 bg-white px-2 dark:border-neutral-700"><img src="{{ asset('images/shipping/jntexpress.svg') }}" class="max-h-6" alt="J&T Express" /></div>
                    <div class="flex h-8 items-center rounded-md border border-gray-200 bg-white px-2 dark:border-neutral-700"><img src="{{ asset('images/shipping/ninjaexpress.webp') }}" class="max-h-6" alt="Ninja Express" /></div>
                    <div class="flex h-8 items-center rounded-md border border-gray-200 bg-white px-2 dark:border-neutral-700"><img src="{{ asset('images/shipping/sicepat.webp') }}" class="max-h-6" alt="SiCepat" /></div>
                </div>
            </div>
        </div>

        <div class="mt-8 flex flex-col items-center justify-between gap-3 border-t border-gray-200 pt-6 sm:flex-row dark:border-neutral-800">
            <p class="text-sm text-gray-500 dark:text-neutral-400">© {{ date('Y') }} {{ config('app.name') }}. Seluruh hak cipta dilindungi.</p>
            <p class="text-sm text-gray-500 dark:text-neutral-400">Dibuat dengan ❤️ untuk developer Indonesia.</p>
        </div>
    </div>
</footer>
<!-- ========== END FOOTER ========== -->
