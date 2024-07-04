{{-- <div class="info-box info-box-new-style">
    <span class="info-box-icon bg-aqua"><i class="ion ion-cash"></i></span>

    <div class="info-box-content">
      <span class="info-box-text"> {{ $total_purchase_heading }} </span>

      @if (isset($dashboard_detail))
          <script>
            document.addEventListener("DOMContentLoaded", function() {
                update_statistics(@json($dashboard_detail->start_date), @json($dashboard_detail->end_date), "total_purchase", @json($dashboard_detail->index), @json($dashboard_detail->location), {{ $user_id ?? null }});
                // Call your function when the content is ready
            });
        </script>
          <span class="info-box-number total_purchase_{{$dashboard_detail->index}}"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
      @else
      <span class="info-box-number total_purchase"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
      @endif
    </div>
    <!-- /.info-box-content -->
</div> --}}

@component('components.static', [
    'svg' => '<svg aria-hidden="true" class="tw-w-6 tw-h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
<path d="M12 3v12"></path>
<path d="M16 11l-4 4l-4 -4"></path>
<path d="M3 12a9 9 0 0 0 18 0"></path>
</svg>',
])
    <p class="tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap">
        {{ $total_purchase_heading }}
    </p>
    @if (isset($dashboard_detail))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                update_statistics(@json($dashboard_detail->start_date), @json($dashboard_detail->end_date), "total_purchase",
                    @json($dashboard_detail->index), @json($dashboard_detail->location), {{ $user_id ?? null }});
                // Call your function when the content is ready
            });
        </script>
        <p
            class="total_purchase_{{ $dashboard_detail->index }} tw-mt-0.5 tw-text-gray-900 tw-text-xl tw-truncate tw-font-semibold tw-tracking-tight tw-font-mono">

        </p>
    @else
        <p
            class="total_purchase tw-mt-0.5 tw-text-gray-900 tw-text-xl tw-truncate tw-font-semibold tw-tracking-tight tw-font-mono">

        </p>
    @endif
@endcomponent
