<div>
	<!-- Header -->
	<div class="border-b border-gray-200 bg-gray-50 dark:border-neutral-800 dark:bg-neutral-900">
		<div class="mx-auto w-full max-w-[85rem] px-4 py-14 text-center sm:px-6 lg:px-8 lg:py-20">
			<span class="inline-flex items-center gap-x-2 rounded-full border border-gray-200 bg-white px-3 py-1 text-xs font-medium text-gray-600 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-300">Pusat Bantuan</span>
			<h1 class="mt-5 text-3xl font-bold tracking-tight text-gray-800 sm:text-4xl dark:text-white">Pertanyaan yang sering diajukan</h1>
			<p class="mx-auto mt-3 max-w-2xl text-gray-600 dark:text-neutral-400">Temukan jawaban cepat seputar pembelian, akses materi, pembayaran, dan pengiriman.</p>
		</div>
	</div>

	<div class="mx-auto w-full max-w-3xl px-4 py-16 sm:px-6 lg:px-8">
		@foreach ($faqs as $group)
			<div class="@if (! $loop->first) mt-12 @endif">
				<h2 class="mb-4 text-lg font-bold text-gray-800 dark:text-white">{{ $group['category'] }}</h2>
				<div class="hs-accordion-group divide-y divide-gray-200 overflow-hidden rounded-xl border border-gray-200 dark:divide-neutral-800 dark:border-neutral-800">
					@foreach ($group['items'] as $i => $item)
						<div class="hs-accordion {{ $loop->parent->first && $i === 0 ? 'active' : '' }} bg-white dark:bg-neutral-900" id="faq-{{ $loop->parent->index }}-{{ $i }}">
							<button class="hs-accordion-toggle inline-flex w-full items-center justify-between gap-x-3 px-5 py-4 text-left text-sm font-semibold text-gray-800 transition hover:bg-gray-50 focus:outline-hidden dark:text-neutral-200 dark:hover:bg-neutral-800"
								aria-expanded="{{ $loop->parent->first && $i === 0 ? 'true' : 'false' }}" aria-controls="faq-content-{{ $loop->parent->index }}-{{ $i }}">
								{{ $item['q'] }}
								<svg class="hs-accordion-active:rotate-180 size-4 shrink-0 text-gray-500 transition" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
							</button>
							<div id="faq-content-{{ $loop->parent->index }}-{{ $i }}"
								class="hs-accordion-content {{ $loop->parent->first && $i === 0 ? '' : 'hidden' }} w-full overflow-hidden transition-[height] duration-300"
								role="region" aria-labelledby="faq-{{ $loop->parent->index }}-{{ $i }}">
								<div class="px-5 pb-5 text-sm leading-relaxed text-gray-600 dark:text-neutral-400">{{ $item['a'] }}</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		@endforeach

		<!-- Still need help -->
		<div class="mt-14 rounded-2xl border border-gray-200 bg-gray-50 p-8 text-center dark:border-neutral-800 dark:bg-neutral-900">
			<h2 class="text-xl font-bold text-gray-900 dark:text-white">Masih ada pertanyaan?</h2>
			<p class="mx-auto mt-2 max-w-md text-sm text-gray-600 dark:text-neutral-400">Tim kami dengan senang hati membantu. Jangan ragu untuk menghubungi kami langsung.</p>
			<a href="{{ route('kontak') }}" class="mt-5 inline-flex items-center justify-center gap-x-2 rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">Hubungi Kami</a>
		</div>
	</div>
</div>
