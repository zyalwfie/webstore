<div>
	<!-- ========== HERO ========== -->
	<div class="relative overflow-hidden border-b border-gray-100 bg-white dark:border-neutral-800 dark:bg-neutral-900">
		<div class="relative mx-auto w-full max-w-[85rem] px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
			<div class="mx-auto max-w-3xl text-center">
				<span class="inline-flex items-center gap-x-2 rounded-full border border-gray-200 bg-gray-50 px-3 py-1 text-xs font-medium text-gray-700 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300">
					<span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
					Kelas baru: Laravel 12 &amp; Livewire 3
				</span>

				<h1 class="mt-6 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl lg:text-6xl dark:text-white">
					Belajar Ngoding dari
					<span class="text-blue-600 dark:text-blue-500">Praktisi Nyata</span>
				</h1>

				<p class="mt-5 text-lg leading-relaxed text-gray-600 dark:text-neutral-400">
					Kelas video, ebook, dan proyek studi kasus untuk web developer Indonesia.
					Dari dasar PHP sampai membangun aplikasi SaaS siap produksi — belajar dengan
					materi yang selalu diperbarui dan akses selamanya.
				</p>

				<div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row">
					<a href="{{ route('katalog') }}"
						class="inline-flex w-full items-center justify-center gap-x-2 rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-hidden sm:w-auto">
						Jelajahi Katalog
						<svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="m9 18 6-6-6-6" />
						</svg>
					</a>
					<a href="{{ route('tentang') }}"
						class="inline-flex w-full items-center justify-center gap-x-2 rounded-lg border border-gray-200 bg-white px-6 py-3 text-sm font-semibold text-gray-800 transition hover:bg-gray-50 focus:outline-hidden sm:w-auto dark:border-neutral-700 dark:bg-neutral-800 dark:text-white dark:hover:bg-neutral-700">
						Kenapa Webstore?
					</a>
				</div>

				<!-- Stats -->
				<div class="mt-14 grid grid-cols-3 gap-4 border-t border-gray-100 pt-8 dark:border-neutral-800">
					<div>
						<p class="text-2xl font-bold text-gray-900 sm:text-3xl dark:text-white">12rb+</p>
						<p class="mt-1 text-xs text-gray-500 sm:text-sm dark:text-neutral-400">Developer bergabung</p>
					</div>
					<div>
						<p class="text-2xl font-bold text-gray-900 sm:text-3xl dark:text-white">40+</p>
						<p class="mt-1 text-xs text-gray-500 sm:text-sm dark:text-neutral-400">Kelas &amp; ebook</p>
					</div>
					<div>
						<p class="text-2xl font-bold text-gray-900 sm:text-3xl dark:text-white">4.9/5</p>
						<p class="mt-1 text-xs text-gray-500 sm:text-sm dark:text-neutral-400">Rating alumni</p>
					</div>
				</div>
			</div>
		</div>

		<!-- Tech strip -->
		<div class="border-t border-gray-100 bg-gray-50 dark:border-neutral-800 dark:bg-neutral-950">
			<div class="mx-auto flex max-w-[85rem] flex-wrap items-center justify-center gap-x-8 gap-y-3 px-4 py-5 text-sm font-semibold text-gray-500 sm:px-6 lg:px-8 dark:text-neutral-400">
				<span class="text-xs uppercase tracking-wider text-gray-400 dark:text-neutral-500">Teknologi yang kamu kuasai:</span>
				<span>PHP</span>
				<span>Laravel</span>
				<span>Livewire</span>
				<span>Filament</span>
				<span>Tailwind CSS</span>
				<span>Ubuntu Server</span>
			</div>
		</div>
	</div>
	<!-- ========== END HERO ========== -->

	<div class="mx-auto w-full max-w-[85rem] px-4 sm:px-6 lg:px-8">
		<!-- ========== COLLECTIONS ========== -->
		@if ($collections->isNotEmpty())
			<section class="py-14 lg:py-20">
				<div class="mb-8 flex flex-wrap items-end justify-between gap-4">
					<div class="max-w-xl">
						<h2 class="text-2xl font-bold text-gray-800 md:text-3xl dark:text-white">Jelajahi berdasarkan topik</h2>
						<p class="mt-2 text-gray-600 dark:text-neutral-400">Pilih jalur belajarmu — mulai dari bahasa pemrograman, framework, hingga deployment ke server.</p>
					</div>
					<a href="{{ route('katalog') }}" class="inline-flex items-center gap-x-1 text-sm font-semibold text-blue-600 hover:text-blue-700 dark:text-blue-500">
						Lihat semua topik
						<svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6" /></svg>
					</a>
				</div>

				<div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
					@foreach ($collections as $collection)
						<a href="{{ route('katalog', ['select_collections' => [$collection->id]]) }}"
							class="group relative flex flex-col justify-between overflow-hidden rounded-xl border border-gray-200 bg-white p-4 transition hover:-translate-y-1 hover:border-blue-300 hover:shadow-md dark:border-neutral-700 dark:bg-neutral-900">
							<span class="mb-8 inline-flex size-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
								<svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6" /><polyline points="8 6 2 12 8 18" /></svg>
							</span>
							<span>
								<span class="block font-semibold text-gray-800 dark:text-white">{{ $collection->name }}</span>
								<span class="text-xs text-gray-500 dark:text-neutral-400">{{ $collection->products_count }} materi</span>
							</span>
						</a>
					@endforeach
				</div>
			</section>
		@endif
		<!-- ========== END COLLECTIONS ========== -->
	</div>

	<!-- ========== FEATURED PRODUCTS ========== -->
	<x-product-sections :products="$featured_products" :url="route('katalog')" title="Kelas Pilihan" />

	<!-- ========== VALUE PROPS ========== -->
	<x-featured-icon />

	<!-- ========== TESTIMONIALS ========== -->
	<section class="bg-gray-50 dark:bg-neutral-900">
		<div class="mx-auto max-w-[85rem] px-4 py-14 sm:px-6 lg:px-8 lg:py-20">
			<div class="mx-auto max-w-2xl text-center">
				<h2 class="text-2xl font-bold text-gray-800 md:text-3xl dark:text-white">Cerita dari alumni</h2>
				<p class="mt-2 text-gray-600 dark:text-neutral-400">Ribuan developer sudah naik level bareng Webstore. Ini kata mereka.</p>
			</div>

			<div class="mt-10 grid grid-cols-1 gap-6 md:grid-cols-3">
				@php($testimonials = [
					['name' => 'Rizky Ananda', 'role' => 'Backend Developer di Tokopedia', 'initials' => 'RA', 'color' => 'bg-blue-600', 'quote' => 'Materinya to the point dan langsung praktik. Cuma dalam 2 bulan aku bisa deploy aplikasi Laravel pertamaku ke VPS sendiri.'],
					['name' => 'Dewi Lestari', 'role' => 'Fullstack Freelancer', 'initials' => 'DL', 'color' => 'bg-violet-600', 'quote' => 'Kelas Livewire-nya juara. Sekarang aku bisa bikin dashboard interaktif tanpa pusing JavaScript. Klien pun makin puas.'],
					['name' => 'Bagus Prakoso', 'role' => 'Mahasiswa Informatika', 'initials' => 'BP', 'color' => 'bg-emerald-600', 'quote' => 'Ebook-nya rapi banget dan gampang dipahami buat pemula. Harga terjangkau tapi kualitasnya kayak bootcamp mahal.'],
				])
				@foreach ($testimonials as $t)
					<figure class="flex h-full flex-col rounded-xl border border-gray-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
						<div class="mb-4 flex gap-0.5 text-amber-400">
							@for ($s = 0; $s < 5; $s++)
								<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .587l3.668 7.431 8.2 1.192-5.934 5.783 1.401 8.168L12 18.896l-7.335 3.865 1.401-8.168L.132 9.21l8.2-1.192z"/></svg>
							@endfor
						</div>
						<blockquote class="grow text-gray-700 dark:text-neutral-300">"{{ $t['quote'] }}"</blockquote>
						<figcaption class="mt-5 flex items-center gap-3">
							<span class="flex size-10 items-center justify-center rounded-full {{ $t['color'] }} text-sm font-semibold text-white">{{ $t['initials'] }}</span>
							<span>
								<span class="block text-sm font-semibold text-gray-800 dark:text-white">{{ $t['name'] }}</span>
								<span class="block text-xs text-gray-500 dark:text-neutral-400">{{ $t['role'] }}</span>
							</span>
						</figcaption>
					</figure>
				@endforeach
			</div>
		</div>
	</section>

	<!-- ========== LATEST PRODUCTS ========== -->
	<x-product-sections :products="$latest_products" :url="route('katalog')" title="Baru Rilis" />

	<!-- ========== NEWSLETTER CTA ========== -->
	<section class="mx-auto w-full max-w-[85rem] px-4 pb-16 sm:px-6 lg:px-8 lg:pb-24">
		<div class="rounded-2xl border border-gray-200 bg-gray-50 px-6 py-12 sm:px-12 lg:py-16 dark:border-neutral-800 dark:bg-neutral-900">
			<div class="mx-auto max-w-2xl text-center">
				<h2 class="text-2xl font-bold text-gray-900 md:text-3xl dark:text-white">Dapatkan tips coding &amp; promo mingguan</h2>
				<p class="mt-3 text-gray-600 dark:text-neutral-400">Gabung ke newsletter kami. Tanpa spam — cuma tutorial pilihan, roadmap belajar, dan diskon eksklusif untuk subscriber.</p>
				<form class="mx-auto mt-7 flex max-w-md flex-col gap-3 sm:flex-row" onsubmit="return false">
					<label for="newsletter-email" class="sr-only">Alamat email</label>
					<input id="newsletter-email" type="email" placeholder="nama@email.com"
						class="w-full rounded-lg border border-gray-200 bg-white px-4 py-3 text-sm text-gray-800 placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500 focus:outline-hidden dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-200" />
					<button type="submit"
						class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-hidden">
						Berlangganan
					</button>
				</form>
				<p class="mt-3 text-xs text-gray-500 dark:text-neutral-500">Dengan berlangganan kamu menyetujui <a href="{{ route('halaman', 'kebijakan-privasi') }}" class="underline hover:text-gray-700 dark:hover:text-neutral-300">Kebijakan Privasi</a> kami.</p>
			</div>
		</div>
	</section>
	<!-- ========== END NEWSLETTER CTA ========== -->
</div>
