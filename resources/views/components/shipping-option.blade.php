@props(['method'])

<label
	class="flex w-full cursor-pointer items-center justify-between gap-2 rounded-lg border border-gray-200 bg-white p-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400"
	for="shipping_method_{{ $method->hash }}">
	<div class="flex items-center justify-start gap-2">
		<input
			class="mt-0.5 shrink-0 rounded-full border-gray-200 text-blue-600 checked:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-800 dark:checked:border-blue-500 dark:checked:bg-blue-500 dark:focus:ring-offset-gray-800"
			id="shipping_method_{{ $method->hash }}" type="radio" value="{{ $method->hash }}"
			wire:key='{{ $method->hash }}' wire:model.live='shipping_selector.shipping_method'>
		@if ($method->logo_url)
			<img class="h-5" src="{{ $method->logo_url }}" />
		@endif

		<span class="ms-3 text-sm text-gray-500 dark:text-neutral-400">
			{{ $method->label }}
		</span>
	</div>
	<span class="text-sm text-gray-800">
		{{ $method->cost_formatted }}
	</span>
</label>
