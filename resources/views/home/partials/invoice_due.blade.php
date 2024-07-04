@component('components.static', [
    'svg' => '<svg aria-hidden="true" class="tw-w-6 tw-h-6" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path
                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                            <path d="M9 7l1 0" />
                                            <path d="M9 13l6 0" />
                                            <path d="M13 17l2 0" />
                                        </svg>',  'svg_bg' => 'tw-bg-yellow-100', 'svg_text' =>  'tw-text-yellow-500'
])
    <p class="tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap">
        {{ $invoice_due_heading }}
    </p>
    @if (isset($dashboard_detail))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                update_statistics(@json($dashboard_detail->start_date), @json($dashboard_detail->end_date), "invoice_due",
                    @json($dashboard_detail->index), @json($dashboard_detail->location), {{ $user_id ?? null }});
                // Call your function when the content is ready
            });
        </script>
        <p
            class="invoice_due_{{ $dashboard_detail->index }} tw-mt-0.5 tw-text-gray-900 tw-text-xl tw-truncate tw-font-semibold tw-tracking-tight tw-font-mono">

        </p>
    @else
        <p
            class="invoice_due tw-mt-0.5 tw-text-gray-900 tw-text-xl tw-truncate tw-font-semibold tw-tracking-tight tw-font-mono">

        </p>
    @endif
@endcomponent
