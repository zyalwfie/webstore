<button type="button" wire:click='remove'
    class="p-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-red-500 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 cursor-pointer">
    <svg wire:loading.remove xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
        fill="currentColor" class="size-4">
        <path
            d="M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z">
        </path>
        <path d="M9 10h2v8H9zm4 0h2v8h-2z"></path>
    </svg>
    <div wire:loading class="animate-spin inline-block size-4 border-3 border-current border-t-transparent text-red-600 rounded-full"
        role="status" aria-label="loading">
        <span class="sr-only">Loading...</span>
    </div>
</button>
