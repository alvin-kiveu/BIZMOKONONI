{{-- <div class="info-box info-box-new-style">
    <span class="info-box-icon bg-red text-white">
        <i class="fas fa-undo-alt"></i>
    </span>

    <div class="info-box-content">
        <span class="info-box-text">
            {{ $total_purchase_return_heading }}
        </span>
        @if (isset($dashboard_detail))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    update_statistics(@json($dashboard_detail->start_date), @json($dashboard_detail->end_date), "total_purchase_return",
                        @json($dashboard_detail->index), @json($dashboard_detail->location));
                    // Call your function when the content is ready
                });
            </script>

            <span class="info-box-number total_purchase_return_{{ $dashboard_detail->index }}"><i
                    class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
    </div>
    <!-- /.info-box-content -->
    <p class="mb-0 text-muted fs-10 mt-5">{{ __('lang_v1.total_purchase_return') }}: <span
            class="total_pr_{{ $dashboard_detail->index }}"></span><br>
        {{ __('lang_v1.total_purchase_return_paid') }}<span class="total_prp_{{ $dashboard_detail->index }}"></span></p>
@else
    <span class="info-box-number total_purchase_return"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
</div>
<!-- /.info-box-content -->
<p class="mb-0 text-muted fs-10 mt-5">{{ __('lang_v1.total_purchase_return') }}: <span class="total_pr"></span><br>
    {{ __('lang_v1.total_purchase_return_paid') }}<span class="total_prp"></span></p>
@endif

</div> --}}

@component('components.static', [
    'svg' => '<svg aria-hidden="true" class="tw-w-6 tw-h-6" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" />
                                                <path d="M15 14v-2a2 2 0 0 0 -2 -2h-4l2 -2m0 4l-2 -2" />
                                            </svg>',
    'svg_bg' => 'tw-text-red-500',
    'svg_text' => 'tw-bg-red-100',
])
    <p class="tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap">
        {{ $total_purchase_return_heading }}

        @if (!isset($dashboard_detail))
            <i class="fa fa-info-circle text-info hover-q no-print" aria-hidden="true" data-container="body"
                data-toggle="popover" data-placement="auto bottom" id="total_prp"
                data-value="{{ __('lang_v1.total_purchase_return') }}-{{ __('lang_v1.total_purchase_return_paid') }}"
                data-content="" data-html="true" data-trigger="hover"></i>
        @endif
    </p>
    @if (isset($dashboard_detail))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                update_statistics(@json($dashboard_detail->start_date), @json($dashboard_detail->end_date), "total_sell",
                    @json($dashboard_detail->index), @json($dashboard_detail->location), {{ $user_id ?? null }});
                // Call your function when the content is ready
            });
        </script>
        <p
            class="total_sell_{{ $dashboard_detail->index }} tw-mt-0.5 tw-text-gray-900 tw-text-xl tw-truncate tw-font-semibold tw-tracking-tight tw-font-mono">

        </p>
        <i class="fa fa-info-circle text-info hover-q no-print" aria-hidden="true" data-container="body"
        data-toggle="popover" data-placement="auto bottom" id="total_prp_{{$dashboard_detail->index}}"
        data-value="{{ __('lang_v1.total_purchase_return') }}-{{ __('lang_v1.total_purchase_return_paid') }}"
        data-content="" data-html="true" data-trigger="hover"></i>
    @else
        <p
            class="total_purchase_return tw-mt-0.5 tw-text-gray-900 tw-text-xl tw-truncate tw-font-semibold tw-tracking-tight tw-font-mono">
        </p>
    @endif
@endcomponent
