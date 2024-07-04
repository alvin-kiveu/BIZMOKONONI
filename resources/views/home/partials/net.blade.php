{{-- <div class="info-box info-box-new-style">
    <span class="info-box-icon bg-green">
        <i class="ion ion-ios-paper-outline"></i>

    </span>

    <div class="info-box-content">
        <span class="info-box-text"> {{ $net_heading }} @show_tooltip(__('lang_v1.net_home_tooltip'))</span>

        @if (isset($dashboard_detail))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    update_statistics(@json($dashboard_detail->start_date), @json($dashboard_detail->end_date), "net",
                        @json($dashboard_detail->index), @json($dashboard_detail->location));
                    // Call your function when the content is ready
                });
            </script>
            <span class="info-box-number net_{{ $dashboard_detail->index }}"><i
                    class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
        @else
            <span class="info-box-number net"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
        @endif
    </div>
    <!-- /.info-box-content -->
</div> --}}

@component('components.static', [
    'svg' => '<svg aria-hidden="true" class="tw-w-6 tw-h-6" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path
                                                d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2">
                                            </path>
                                            <path
                                                d="M14.8 8a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1">
                                            </path>
                                            <path d="M12 6v10"></path>
                                        </svg>', 'svg_bg' => 'tw-bg-green-100' , 'svg_text' => 'tw-text-green-500'
])
    <p class="tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap">
        {{ $net_heading }} @show_tooltip(__('lang_v1.net_home_tooltip'))
    </p>
    @if (isset($dashboard_detail))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                update_statistics(@json($dashboard_detail->start_date), @json($dashboard_detail->end_date), "net",
                    @json($dashboard_detail->index), @json($dashboard_detail->location), {{ $user_id ?? null }});
                // Call your function when the content is ready
            });
        </script>
        <p
            class="net_{{ $dashboard_detail->index }} tw-mt-0.5 tw-text-gray-900 tw-text-xl tw-truncate tw-font-semibold tw-tracking-tight tw-font-mono">

        </p>
    @else
        <p class="net tw-mt-0.5 tw-text-gray-900 tw-text-xl tw-truncate tw-font-semibold tw-tracking-tight tw-font-mono">

        </p>
    @endif
@endcomponent
