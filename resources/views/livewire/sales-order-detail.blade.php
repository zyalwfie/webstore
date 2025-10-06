<div>
    @push('head')
        <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js" defer></script>
        <script type="text/javascript" defer>
            window.addEventListener("load", function() {
                confetti({
                    particleCount: 100,
                    spread: 70,
                    origin: {
                        y: 0.6
                    }
                });
            });
        </script>
    @endpush

    <div class="container mx-auto w-full max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto w-full p-5 md:w-1/2">
            <div class="pointer-events-auto relative flex flex-col rounded-xl bg-white shadow-lg dark:bg-neutral-800">
                <div class="relative min-h-32 overflow-hidden rounded-t-xl bg-gray-900 text-center dark:bg-neutral-950">

                    <!-- SVG Background Element -->
                    <figure class="absolute inset-x-0 bottom-0 -mb-px">
                        <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                            viewBox="0 0 1920 100.1">
                            <path fill="currentColor" class="fill-white dark:fill-neutral-800"
                                d="M0,0c0,0,934.4,93.4,1920,0v100.1H0L0,0z"></path>
                        </svg>
                    </figure>
                    <!-- End SVG Background Element -->
                </div>

                <div class="relative z-10 -mt-12">
                    <!-- Icon -->
                    <span
                        class="size-15.5 shadow-2xs mx-auto flex items-center justify-center rounded-full border border-gray-200 bg-white text-gray-700 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-400">
                        <svg class="size-6 shrink-0" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" viewBox="0 0 16 16">
                            <path
                                d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />
                            <path
                                d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                        </svg>
                    </span>
                    <!-- End Icon -->
                </div>

                <!-- Body -->
                <div class="overflow-y-auto p-4 sm:p-7">
                    <div class="text-center">
                        <h3 id="hs-ai-modal-label" class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                            Invoice from {{ config('app.name') }}
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-neutral-500">
                            Invoice #3682303
                        </p>
                    </div>

                    <div class="mt-5 sm:mt-10">
                        <h4 class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Summary</h4>

                        <ul class="mt-3 flex flex-col">
                            <li
                                class="-mt-px inline-flex items-center gap-x-2 border border-gray-200 px-4 py-3 text-sm text-gray-800 first:mt-0 first:rounded-t-lg last:rounded-b-lg dark:border-neutral-700 dark:text-neutral-200">
                                <div class="flex w-full items-center justify-between">
                                    <span>Customer Name</span>
                                    <span>{{ $order->customer->full_name }}</span>
                                </div>
                            </li>
                            <li
                                class="-mt-px inline-flex items-center gap-x-2 border border-gray-200 px-4 py-3 text-sm text-gray-800 first:mt-0 first:rounded-t-lg last:rounded-b-lg dark:border-neutral-700 dark:text-neutral-200">
                                <div class="flex w-full items-center justify-between">
                                    <span>Due Date</span>
                                    <span>{{ $order->due_date_at->diffForHumans() }} - {{ $order->due_date_at }}</span>
                                </div>
                            </li>
                            <li
                                class="-mt-px inline-flex items-center gap-x-2 border border-gray-200 px-4 py-3 text-sm text-gray-800 first:mt-0 first:rounded-t-lg last:rounded-b-lg dark:border-neutral-700 dark:text-neutral-200">
                                <div class="flex w-full items-center justify-between">
                                    <span>Payment Method</span>
                                    <span>{{ $order->payment->label }}</span>
                                </div>
                            </li>
                            <li
                                class="-mt-px inline-flex items-center gap-x-2 border border-gray-200 bg-gray-50 px-4 py-3 text-sm font-semibold text-gray-800 first:mt-0 first:rounded-t-lg last:rounded-b-lg dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-200">
                                <div class="flex w-full items-center justify-between">
                                    <span>Total Transfer</span>
                                    <span>{{ $order->total_formatted }}</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Button -->
                    @if ($is_redirect)
                        <a href="#"
                            class="text-md focus:outline-hidden block w-full gap-x-2 rounded-lg border border-transparent bg-blue-600 px-3 py-2 text-center font-medium text-white hover:bg-blue-700 focus:bg-blue-700 disabled:pointer-events-none disabled:opacity-50">
                            Pay now
                        </a>
                    @else
                        <span class="text-center block py-2">Please contact us at 123</span>
                    @endif
                    <!-- End Buttons -->
                </div>
            </div>
        </div>
    </div>
</div>
