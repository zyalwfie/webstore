<div>
	<!-- Header -->
	<div class="border-b border-gray-200 bg-gray-50 dark:border-neutral-800 dark:bg-neutral-900">
		<div class="mx-auto w-full max-w-[85rem] px-4 py-14 text-center sm:px-6 lg:px-8 lg:py-20">
			<h1 class="text-3xl font-bold tracking-tight text-gray-800 sm:text-4xl dark:text-white">Ada yang bisa kami bantu?</h1>
			<p class="mx-auto mt-3 max-w-2xl text-gray-600 dark:text-neutral-400">Tim kami siap membantu soal materi, pembayaran, akses kelas, atau apa pun. Isi formulir di bawah atau hubungi kami lewat kanal berikut.</p>
		</div>
	</div>

	<div class="mx-auto w-full max-w-[85rem] px-4 py-16 sm:px-6 lg:px-8">
		<div class="grid gap-10 lg:grid-cols-5 lg:gap-16">
			<!-- Contact info -->
			<div class="lg:col-span-2">
				<h2 class="text-xl font-bold text-gray-800 dark:text-white">Informasi kontak</h2>
				<p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">Kami biasanya membalas dalam 1×24 jam pada hari kerja.</p>

				<div class="mt-8 space-y-6">
					<div class="flex gap-4">
						<span class="inline-flex size-11 shrink-0 items-center justify-center rounded-lg bg-blue-600/10 text-blue-600 dark:text-blue-400">
							<svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
						</span>
						<div>
							<h3 class="text-sm font-semibold text-gray-800 dark:text-white">Email</h3>
							<p class="text-sm text-gray-600 dark:text-neutral-400">halo@webstore.test</p>
							<p class="text-sm text-gray-600 dark:text-neutral-400">support@webstore.test</p>
						</div>
					</div>
					<div class="flex gap-4">
						<span class="inline-flex size-11 shrink-0 items-center justify-center rounded-lg bg-blue-600/10 text-blue-600 dark:text-blue-400">
							<svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
						</span>
						<div>
							<h3 class="text-sm font-semibold text-gray-800 dark:text-white">Telepon &amp; WhatsApp</h3>
							<p class="text-sm text-gray-600 dark:text-neutral-400">+62 812 3456 7890</p>
							<p class="text-xs text-gray-500 dark:text-neutral-500">Senin–Jumat, 09.00–17.00 WIB</p>
						</div>
					</div>
					<div class="flex gap-4">
						<span class="inline-flex size-11 shrink-0 items-center justify-center rounded-lg bg-blue-600/10 text-blue-600 dark:text-blue-400">
							<svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
						</span>
						<div>
							<h3 class="text-sm font-semibold text-gray-800 dark:text-white">Kantor</h3>
							<p class="text-sm text-gray-600 dark:text-neutral-400">Jl. Teknologi No. 12, Sleman,<br>Daerah Istimewa Yogyakarta 55281</p>
						</div>
					</div>
				</div>

				<div class="mt-8 rounded-xl border border-gray-200 bg-gray-50 p-5 dark:border-neutral-800 dark:bg-neutral-900">
					<h3 class="text-sm font-semibold text-gray-800 dark:text-white">Butuh jawaban cepat?</h3>
					<p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">Sebagian besar pertanyaan sudah kami jawab di halaman <a href="{{ route('tanya-jawab') }}" class="font-medium text-blue-600 hover:underline dark:text-blue-400">FAQ</a>.</p>
				</div>
			</div>

			<!-- Form -->
			<div class="lg:col-span-3">
				<div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8 dark:border-neutral-800 dark:bg-neutral-900">
					@if ($sent)
						<div class="mb-6 flex items-start gap-3 rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800 dark:border-emerald-900 dark:bg-emerald-950/50 dark:text-emerald-300" role="alert">
							<svg class="mt-0.5 size-5 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg>
							<span><strong>Terima kasih!</strong> Pesanmu sudah kami terima. Tim kami akan segera menghubungimu.</span>
						</div>
					@endif

					<h2 class="text-xl font-bold text-gray-800 dark:text-white">Kirim pesan</h2>
					<p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">Isi formulir berikut dan kami akan membalasnya secepat mungkin.</p>

					<form wire:submit="submit" class="mt-6 space-y-5">
						<div class="grid gap-5 sm:grid-cols-2">
							<div>
								<label for="name" class="mb-2 block text-sm font-medium text-gray-800 dark:text-neutral-200">Nama lengkap</label>
								<input type="text" id="name" wire:model="name" placeholder="Nama kamu"
									class="block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300 dark:placeholder-neutral-500 @error('name') border-red-500 @enderror">
								@error('name') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
							</div>
							<div>
								<label for="email" class="mb-2 block text-sm font-medium text-gray-800 dark:text-neutral-200">Email</label>
								<input type="email" id="email" wire:model="email" placeholder="nama@email.com"
									class="block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300 dark:placeholder-neutral-500 @error('email') border-red-500 @enderror">
								@error('email') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
							</div>
						</div>
						<div>
							<label for="subject" class="mb-2 block text-sm font-medium text-gray-800 dark:text-neutral-200">Subjek</label>
							<input type="text" id="subject" wire:model="subject" placeholder="Apa yang ingin kamu tanyakan?"
								class="block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300 dark:placeholder-neutral-500 @error('subject') border-red-500 @enderror">
							@error('subject') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
						</div>
						<div>
							<label for="message" class="mb-2 block text-sm font-medium text-gray-800 dark:text-neutral-200">Pesan</label>
							<textarea id="message" rows="5" wire:model="message" placeholder="Tulis pesanmu di sini..."
								class="block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300 dark:placeholder-neutral-500 @error('message') border-red-500 @enderror"></textarea>
							@error('message') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
						</div>
						<button type="submit"
							class="inline-flex w-full items-center justify-center gap-x-2 rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-blue-500 focus:outline-hidden disabled:pointer-events-none disabled:opacity-60 sm:w-auto"
							wire:loading.attr="disabled" wire:target="submit">
							<span wire:loading.remove wire:target="submit">Kirim pesan</span>
							<span wire:loading wire:target="submit">Mengirim...</span>
							<svg wire:loading.remove wire:target="submit" class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z"/><path d="m21.854 2.147-10.94 10.939"/></svg>
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
