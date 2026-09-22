<div>
	<!-- Hero -->
	<div class="relative overflow-hidden bg-neutral-950">
		<div aria-hidden="true" class="pointer-events-none absolute inset-0">
			<div class="absolute -top-24 left-1/4 h-96 w-96 rounded-full bg-blue-600/25 blur-3xl"></div>
			<div class="absolute -bottom-24 right-1/4 h-96 w-96 rounded-full bg-violet-600/20 blur-3xl"></div>
		</div>
		<div class="relative mx-auto w-full max-w-[85rem] px-4 py-20 text-center sm:px-6 lg:px-8 lg:py-24">
			<span class="inline-flex items-center gap-x-2 rounded-full border border-white/15 bg-white/5 px-3 py-1 text-xs font-medium text-neutral-200">Tentang Webstore</span>
			<h1 class="mx-auto mt-6 max-w-3xl text-4xl font-bold tracking-tight text-white sm:text-5xl">Kami percaya siapa pun bisa jadi developer hebat</h1>
			<p class="mx-auto mt-5 max-w-2xl text-lg text-neutral-300">Webstore lahir dari keresahan sederhana: materi belajar ngoding yang bagus sering kali mahal, berbahasa asing, dan jauh dari praktik nyata. Kami hadir untuk mengubahnya.</p>
		</div>
	</div>

	<!-- Stats -->
	<div class="mx-auto w-full max-w-[85rem] px-4 sm:px-6 lg:px-8">
		<div class="-mt-10 grid grid-cols-2 gap-px overflow-hidden rounded-2xl border border-gray-200 bg-gray-200 shadow-sm lg:grid-cols-4 dark:border-neutral-800 dark:bg-neutral-800">
			@foreach ($stats as $stat)
				<div class="bg-white p-6 text-center dark:bg-neutral-900">
					<p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $stat['value'] }}</p>
					<p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">{{ $stat['label'] }}</p>
				</div>
			@endforeach
		</div>
	</div>

	<!-- Story -->
	<section class="mx-auto w-full max-w-[85rem] px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
		<div class="grid gap-12 lg:grid-cols-2 lg:items-center">
			<div>
				<h2 class="text-2xl font-bold text-gray-800 md:text-3xl dark:text-white">Cerita kami</h2>
				<div class="mt-5 space-y-4 text-gray-600 dark:text-neutral-400">
					<p>Berawal dari kanal tutorial kecil pada 2020, kami membagikan cara membangun aplikasi web dengan PHP dan Laravel secara gratis. Respons komunitas luar biasa — ternyata banyak sekali yang ingin belajar, tapi kesulitan menemukan sumber berbahasa Indonesia yang runut dan relevan dengan kebutuhan industri.</p>
					<p>Dari sana Webstore tumbuh menjadi platform yang menyediakan kelas video, ebook, dan proyek studi kasus. Setiap materi dirancang oleh praktisi yang benar-benar membangun produk setiap hari, bukan sekadar teori.</p>
					<p>Hari ini, ribuan developer sudah memulai atau mempercepat kariernya bersama kami. Dan kami baru saja memulai.</p>
				</div>
			</div>
			<div class="rounded-2xl bg-gradient-to-br from-blue-600 via-sky-500 to-violet-600 p-1">
				<div class="grid h-full grid-cols-2 gap-4 rounded-xl bg-neutral-950 p-8 text-white">
					<div class="col-span-2">
						<p class="text-sm font-semibold uppercase tracking-wider text-blue-300">Misi kami</p>
						<p class="mt-2 text-lg font-medium">Membuat pendidikan teknologi berkualitas bisa diakses siapa saja, di mana saja, dengan harga yang masuk akal.</p>
					</div>
					<div class="rounded-lg bg-white/5 p-4">
						<p class="text-2xl font-bold">100%</p>
						<p class="mt-1 text-xs text-neutral-400">Praktik berbasis proyek nyata</p>
					</div>
					<div class="rounded-lg bg-white/5 p-4">
						<p class="text-2xl font-bold">∞</p>
						<p class="mt-1 text-xs text-neutral-400">Akses selamanya + update</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Values -->
	<section class="bg-gray-50 dark:bg-neutral-900">
		<div class="mx-auto w-full max-w-[85rem] px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
			<div class="mx-auto max-w-2xl text-center">
				<h2 class="text-2xl font-bold text-gray-800 md:text-3xl dark:text-white">Nilai yang kami pegang</h2>
				<p class="mt-2 text-gray-600 dark:text-neutral-400">Prinsip-prinsip ini memandu cara kami membuat setiap materi.</p>
			</div>
			@php($values = [
				['title' => 'Praktik dulu, teori kemudian', 'desc' => 'Kamu belajar dengan membangun aplikasi sungguhan, bukan menghafal konsep tanpa konteks.', 'icon' => '<path d="m18 16 4-4-4-4"/><path d="m6 8-4 4 4 4"/><path d="m14.5 4-5 16"/>'],
				['title' => 'Bahasa yang membumi', 'desc' => 'Semua materi berbahasa Indonesia, disusun runut dari nol sampai mahir tanpa istilah yang membingungkan.', 'icon' => '<path d="m5 8 6 6"/><path d="m4 14 6-6 2-3"/><path d="M2 5h12"/><path d="M7 2h1"/><path d="m22 22-5-10-5 10"/><path d="M14 18h6"/>'],
				['title' => 'Selalu diperbarui', 'desc' => 'Teknologi bergerak cepat. Kami memperbarui materi mengikuti versi terbaru, dan kamu dapat aksesnya gratis.', 'icon' => '<path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/><path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"/><path d="M8 16H3v5"/>'],
			])
			<div class="mt-10 grid gap-6 md:grid-cols-3">
				@foreach ($values as $value)
					<div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-neutral-700 dark:bg-neutral-800">
						<span class="inline-flex size-11 items-center justify-center rounded-lg bg-blue-600/10 text-blue-600 dark:text-blue-400">
							<svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $value['icon'] !!}</svg>
						</span>
						<h3 class="mt-4 font-semibold text-gray-800 dark:text-white">{{ $value['title'] }}</h3>
						<p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">{{ $value['desc'] }}</p>
					</div>
				@endforeach
			</div>
		</div>
	</section>

	<!-- CTA -->
	<section class="mx-auto w-full max-w-[85rem] px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
		<div class="rounded-2xl border border-gray-200 bg-white p-8 text-center sm:p-12 dark:border-neutral-800 dark:bg-neutral-900">
			<h2 class="text-2xl font-bold text-gray-800 md:text-3xl dark:text-white">Siap mulai perjalanan ngodingmu?</h2>
			<p class="mx-auto mt-3 max-w-xl text-gray-600 dark:text-neutral-400">Jelajahi katalog kami dan temukan kelas atau ebook yang paling pas dengan tujuanmu.</p>
			<div class="mt-7 flex flex-col items-center justify-center gap-3 sm:flex-row">
				<a href="{{ route('product-catalog') }}" class="inline-flex items-center justify-center gap-x-2 rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-blue-500">Lihat Katalog</a>
				<a href="{{ route('contact') }}" class="inline-flex items-center justify-center gap-x-2 rounded-lg border border-gray-200 px-6 py-3 text-sm font-semibold text-gray-800 transition hover:bg-gray-50 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">Hubungi Kami</a>
			</div>
		</div>
	</section>
</div>
