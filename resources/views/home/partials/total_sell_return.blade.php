{{-- <div class="info-box info-box-new-style">
    <span class="info-box-icon bg-red text-white">
         <i class="fas fa-exchange-alt"></i>
    </span>

     <div class="info-box-content">
       <span class="info-box-text">  {{ $total_sell_return_heading }}</span>
       @if (isset($dashboard_detail))
       <script>
        document.addEventListener("DOMContentLoaded", function() {
            update_statistics(@json($dashboard_detail->start_date), @json($dashboard_detail->end_date), "total_sell_return", @json($dashboard_detail->index), @json($dashboard_detail->location), {{ $user_id ?? null }});
            // Call your function when the content is ready
        });
    </script>          
          <span class="info-box-number total_sell_return_{{$dashboard_detail->index}}"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
        </div>
        <!-- /.info-box-content -->
        <p class="mb-0 text-muted fs-10 mt-5">{{ __('lang_v1.total_sell_return')}}: <span class="total_sr_{{$dashboard_detail->index}}"></span><br>
            {{ __('lang_v1.total_sell_return_paid')}}<span class="total_srp_{{$dashboard_detail->index}}"></span></p>
      @else

        <span class="info-box-number total_sell_return"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
        </div>
        <!-- /.info-box-content -->
        <p class="mb-0 text-muted fs-10 mt-5">{{ __('lang_v1.total_sell_return')}}: <span class="total_sr"></span><br>
            {{ __('lang_v1.total_sell_return_paid')}}<span class="total_srp"></span></p>
      @endif
 </div> --}}


@component('components.static', [
    'svg' => ' <svg aria-hidden="true" class="tw-w-6 tw-h-6" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M21 7l-18 0" />
                                            <path d="M18 10l3 -3l-3 -3" />
                                            <path d="M6 20l-3 -3l3 -3" />
                                            <path d="M3 17l18 0" />
                                        </svg>',
    'svg_text' => 'tw-text-red-500',
    'svg_bg' => 'tw-bg-red-100',
])
    <p class="tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap">
        {{ $total_sell_return_heading }} 

        @if (!isset($dashboard_detail))
            
            <i class="fa fa-info-circle text-info hover-q no-print" aria-hidden="true" data-container="body"
                data-toggle="popover" data-placement="auto bottom" id="total_srp"
                data-value="{{ __('lang_v1.total_sell_return') }}-{{ __('lang_v1.total_sell_return_paid') }}"
                data-content="" data-html="true" data-trigger="hover"></i>
        @endif
    </p>
    @if (isset($dashboard_detail))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                update_statistics(@json($dashboard_detail->start_date), @json($dashboard_detail->end_date), "total_sell_return",
                    @json($dashboard_detail->index), @json($dashboard_detail->location), {{ $user_id ?? null }});
                // Call your function when the content is ready
            });
        </script>
        <p
            class="total_sell_return_{{ $dashboard_detail->index }} tw-mt-0.5 tw-text-gray-900 tw-text-xl tw-truncate tw-font-semibold tw-tracking-tight tw-font-mono">

        </p> <i class="fa fa-info-circle text-info hover-q no-print" aria-hidden="true" data-container="body"
        data-toggle="popover" data-placement="auto bottom" id="total_srp_{{ $dashboard_detail->index }}"
        data-value="{{ __('lang_v1.total_sell_return') }}-{{ __('lang_v1.total_sell_return_paid') }}" data-content=""
        data-html="true" data-trigger="hover"></i>
    @else
        <p
            class="total_sell_return tw-mt-0.5 tw-text-gray-900 tw-text-xl tw-truncate tw-font-semibold tw-tracking-tight tw-font-mono">
        </p>
    @endif
@endcomponent
