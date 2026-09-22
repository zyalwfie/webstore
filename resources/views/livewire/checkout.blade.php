<div class="container mx-auto w-full max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8">
			<div class="grid gap-5 md:grid-cols-2 md:gap-20">
						<div class="p-10">
									<!-- Section -->
									<div
												class="border-t border-gray-200 py-6 first:border-transparent first:pt-0 last:pb-0 dark:border-neutral-700 dark:first:border-transparent">
												<label class="inline-block text-sm font-medium dark:text-white" for="af-payment-billing-contact">
															Kontak Pemesan
												</label>

												<div class="mt-2 grid grid-cols-2 gap-3">
															<div class="col-span-2">
																		<input
																					class="shadow-2xs @error('data.full_name') border-red-600 @enderror block w-full rounded-lg border-gray-200 px-3 py-1.5 pe-11 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 sm:py-2 sm:text-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
																					id="af-payment-billing-contact" placeholder="Nama Lengkap" type="text" wire:model='data.full_name'>
																		@error('data.full_name')
																					<p class="mt-2 text-xs text-red-600" id="hs-validation-name-error-helper">
																								{{ $message }}</p>
																		@enderror
															</div>
															<div>
																		<input
																					class="shadow-2xs @error('data.email') border-red-600 @enderror block w-full rounded-lg border-gray-200 px-3 py-1.5 pe-11 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 sm:py-2 sm:text-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
																					placeholder="Email" type="text" wire:model='data.email'>
																		@error('data.email')
																					<p class="mt-2 text-xs text-red-600" id="hs-validation-name-error-helper">
																								{{ $message }}</p>
																		@enderror
															</div>
															<div>
																		<input
																					class="shadow-2xs @error('data.phone') border-red-600 @enderror block w-full rounded-lg border-gray-200 px-3 py-1.5 pe-11 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 sm:py-2 sm:text-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
																					placeholder="Nomor Telepon" type="text" wire:model='data.phone'>
																		@error('data.phone')
																					<p class="mt-2 text-xs text-red-600" id="hs-validation-name-error-helper">
																								{{ $message }}</p>
																		@enderror
															</div>
												</div>
									</div>
									<!-- Section -->
									<div
												class="mt-5 border-t border-gray-200 py-6 first:border-transparent first:pt-0 last:pb-0 dark:border-neutral-700 dark:first:border-transparent">
												<label class="inline-block text-sm font-medium dark:text-white" for="af-payment-billing-address">
															Alamat Pengiriman
												</label>

												<div class="mt-2 space-y-3">
															<input
																		class="shadow-2xs @error('data.address_line') border-red-600 @enderror block w-full rounded-lg border-gray-200 px-3 py-1.5 pe-11 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 sm:py-2 sm:text-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
																		id="af-payment-billing-address" placeholder="Alamat Lengkap" type="text"
																		wire:model='data.address_line'>
															@error('data.address_line')
																		<p class="mt-2 text-xs text-red-600" id="hs-validation-name-error-helper">
																					{{ $message }}</p>
															@enderror
															<div class="relative w-full" x-data="{ open: false }">
																		<div aria-label="loading"
																					class="border-3 absolute right-3 top-3 inline-block size-4 animate-spin rounded-full border-current border-t-transparent text-blue-600 dark:text-blue-500"
																					role="status" wire:loading wire:target='region_selector.keyword'>
																					<span class="sr-only">Memuat...</span>
																		</div>

																		<input @click.outside="open = false" @focus="open = true"
																					class="shadow-2xs block w-full rounded-lg border-gray-200 py-1.5 pe-11 pl-3 focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 sm:py-2 sm:text-sm dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
																					placeholder="Cari Lokasi" type="text" wire:model.live.debounce.500ms='region_selector.keyword'>

																		<div class="absolute z-10 mt-1 w-full overflow-hidden rounded-b-lg bg-white" wire:loading
																					wire:target='region_selector.keyword'>
																					<ul class="animate-pulse space-y-3 rounded-b-lg border border-gray-200 p-2">
																								<li class="h-4 w-full rounded-full bg-gray-200 dark:bg-neutral-700"></li>
																								<li class="h-4 w-full rounded-full bg-gray-200 dark:bg-neutral-700"></li>
																								<li class="h-4 w-full rounded-full bg-gray-200 dark:bg-neutral-700"></li>
																					</ul>
																		</div>

																		@if ($this->regions->toCollection()->isNotEmpty())
																					<ul class="absolute z-10 mt-1 max-h-60 w-full overflow-y-auto rounded-b-lg border border-gray-200 bg-white"
																								x-show="open">
																								@foreach ($this->regions as $region)
																											<li class="cursor-pointer p-2 hover:bg-gray-100">
																														<label for="region-{{ $region->code }}">
																																	{{ $region->label }}
																																	<input class="sr-only" id="region-{{ $region->code }}" type="radio"
																																				value="{{ $region->code }}" wire:model.live='region_selector.region_selected'>
																														</label>
																											</li>
																								@endforeach
																					</ul>
																		@elseif (!empty($region_selector['keyword']) && $this->regions->toCollection()->isEmpty())
																					<ul class="absolute z-10 mt-1 max-h-60 w-full overflow-y-auto rounded-b-lg border border-gray-200 bg-white"
																								x-show="open">
																								<li class="cursor-pointer p-2 hover:bg-gray-100">
																											<div>
																														Data wilayah tidak ditemukan.
																											</div>
																								</li>
																					</ul>
																		@endif

																		@if ($this->region)
																					<p class="mt-2 text-sm text-gray-600">
																								Lokasi Dipilih
																								<strong>{{ $this->region->label }}</strong>
																					</p>
																		@endif
															</div>
															@error('data.destination_region_code')
																		<p class="mt-2 text-xs text-red-600" id="hs-validation-name-error-helper">
																					{{ $message }}</p>
															@enderror
												</div>
									</div>
									<!-- End Section -->
									<label class="inline-block text-sm font-medium dark:text-white" for="af-shipping-method">
												Metode Pengiriman
									</label>

									@error('data.shipping_hash')
												<p class="mt-2 text-xs text-red-600" id="hs-validation-name-error-helper">
															{{ $message }}</p>
									@enderror

									<div class="mt-2 space-y-3">
												<div class="flex">
															<div aria-label="loading"
																		class="border-3 inline-block size-4 animate-spin rounded-full border-current border-t-transparent text-blue-600 dark:text-blue-500"
																		role="status" wire:loading wire:target='region_selector.region_selected'>
																		<span class="sr-only">Memuat...</span>
															</div>
												</div>
												<div class="grid space-y-2">
															@if (!data_get($data, 'destination_region_code'))
																		<div class="text-xs text-red-600">Fill Shipping Address First</div>
															@else
																		{{-- Internal / offline couriers: resolved instantly --}}
																		@foreach ($this->offline_shipping_methods as $group_name => $shipping_method_groups)
																			<div class="text-xs font-bold">
																				{{ $group_name }}
																			</div>
																			@foreach ($shipping_method_groups as $shipping_method)
																				<x-shipping-option :method="$shipping_method" />
																			@endforeach
																		@endforeach

																		{{-- External API couriers: loaded lazily so render never blocks --}}
																		<div wire:key="api-shipping-{{ data_get($data, 'destination_region_code') }}"
																			@if (!$api_shipping_loaded) wire:init="loadApiShipping" @endif>
																			@if (!$api_shipping_loaded)
																				<div class="flex items-center gap-2 py-1 text-xs text-gray-500">
																					<span
																						class="border-3 inline-block size-4 animate-spin rounded-full border-current border-t-transparent text-blue-600"
																						role="status" aria-label="loading"></span>
																					Memuat kurir lainnya...
																				</div>
																			@elseif ($api_shipping_failed)
																				<div class="text-xs text-amber-600">
																					Kurir eksternal sedang tidak tersedia. Silakan gunakan kurir internal.
																				</div>
																			@else
																				@foreach ($this->api_shipping_methods as $group_name => $shipping_method_groups)
																					<div class="text-xs font-bold">
																						{{ $group_name }}
																					</div>
																					@foreach ($shipping_method_groups as $shipping_method)
																						<x-shipping-option :method="$shipping_method" />
																					@endforeach
																				@endforeach
																			@endif
																		</div>
															@endif
												</div>
									</div>

									<label class="mt-5 inline-block text-sm font-medium dark:text-white" for="af-payment-method">
												Metode Pembayaran
									</label>
									<div class="mt-2 space-y-3">
												<div class="grid space-y-2">
															@foreach ($this->payment_methods->toCollection() as $key => $payment_method)
																		<label
																					class="flex w-full rounded-lg border border-gray-200 bg-white p-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400"
																					for="payment_method_{{ $payment_method->hash }}">
																					<input
																								class="mt-0.5 shrink-0 rounded-full border-gray-200 text-blue-600 checked:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-800 dark:checked:border-blue-500 dark:checked:bg-blue-500 dark:focus:ring-offset-gray-800"
																								id="payment_method_{{ $payment_method->hash }}" type="radio"
																								value="{{ $payment_method->hash }}" wire:key='payment-method-{{ $payment_method->hash }}'
																								wire:model.live='payment_method_selector.payment_method_selected'>
																					<span
																								class="ms-3 text-sm text-gray-500 dark:text-neutral-400">{{ $payment_method->label }}</span>
																		</label>
															@endforeach
												</div>
									</div>
									@error('data.payment_method_hash')
												<p class="mt-2 text-xs text-red-600" id="hs-validation-name-error-helper">
															{{ $message }}</p>
									@enderror
						</div>
						<div class="p-10">
									<h1 class="mb-5 text-2xl font-light">Ringkasan Pesanan</h1>
									<div>
												@foreach ($cart->items as $item)
															<x-single-product-list :cart_item="$item" />
												@endforeach
									</div>
									<div class="grid gap-5">
												<!-- List Group -->
												<ul class="mt-3 flex flex-col">
															<li
																		class="-mt-px inline-flex items-center gap-x-2 border border-gray-200 px-4 py-3 text-sm text-gray-800 first:mt-0 first:rounded-t-lg last:rounded-b-lg dark:border-neutral-700 dark:text-neutral-200">
																		<div class="flex w-full items-center justify-between">
																					<span>Subtotal</span>
																					<span>{{ data_get($this->summaries, 'sub_total_formatted') }}</span>
																		</div>
															</li>
															<li
																		class="relative -mt-px min-h-16 border-x border-gray-200 px-4 py-3 text-sm text-gray-800 first:mt-0 first:rounded-t-lg last:rounded-b-lg dark:border-neutral-700 dark:text-neutral-200">
																		<div class="flex w-full items-center justify-between" wire:loading.remove
																					wire:target='shipping_selector.shipping_method'>
																					<div class="flex flex-col">
																								<span>{{ $this->shipping_method?->label ?? '-' }}</span>
																								<span class="text-xs">{{ $this->shipping_method?->weight ?? '0' }}</span>
																					</div>
																					<span>{{ data_get($this->summaries, 'shipping_total_formatted') }}</span>
																		</div>
																		<div class="flex h-full w-full items-center justify-center">
																					<div aria-label="loading"
																								class="border-3 size-5 animate-spin rounded-full border-current border-t-transparent text-blue-600 dark:text-blue-500"
																								role="status" wire:loading wire:target='shipping_selector.shipping_method'>
																								<span class="sr-only">Memuat...</span>
																					</div>
																		</div>
															</li>
															<li
																		class="-mt-px inline-flex items-center gap-x-2 border border-gray-200 px-4 py-3 text-sm font-semibold text-gray-800 first:mt-0 first:rounded-t-lg last:rounded-b-lg dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-200">
																		<div class="flex w-full items-center justify-between">
																					<span>Total</span>
																					<span>{{ data_get($this->summaries, 'grand_total_formatted') }}</span>
																		</div>
															</li>
												</ul>
												<!-- End List Group -->
												<button
															class="focus:outline-hidden inline-flex w-full cursor-pointer items-center justify-center gap-x-2 rounded-lg border border-transparent bg-blue-600 px-3 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:bg-blue-700 disabled:pointer-events-none disabled:opacity-50"
															type="button" wire:click='placeAnOrder' wire:loading.attr='disabled'>
															<span wire:loading.remove>Buat Pesanan</span>
															<span aria-label="loading"
																		class="border-3 inline-block size-4 animate-spin rounded-full border-current border-t-transparent text-white"
																		role="status" wire:loading></span>
															<span wire:loading>Memuat</span>
												</button>
									</div>
						</div>
			</div>
</div>
