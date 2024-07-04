{{-- <div class="box @if (!empty($class)) {{$class}} @else box-solid @endif" id="accordion">
  <div class="box-header with-border" style="cursor: pointer;">
    <h3 class="box-title">
      <a data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
        @if (!empty($icon)) {!! $icon !!} @else <i class="fa fa-filter" aria-hidden="true"></i> @endif {{$title ?? ''}}
      </a>
    </h3>
  </div>
  @php
    if(isMobile()) {
      $closed = true;
    }
  @endphp
  <div id="collapseFilter" class="panel-collapse active collapse @if (empty($closed)) in @endif" aria-expanded="true">
    <div class="box-body">
      {{$slot}}
    </div>
  </div>
</div> --}}


<div
    class="tw-transition-all tw-mb-4 lg:tw-col-span-1 tw-duration-200 tw-bg-white tw-shadow-sm tw-rounded-xl tw-ring-1 hover:tw-shadow-md hover:tw-translate-y-0.5 tw-ring-gray-200">
    <div class="box-header with-border" style="cursor: pointer;">
        <h3 class="box-title tw-pt-2 tw-pb-2 tw-pl-2">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
                @if (!empty($icon))
                    {!! $icon !!}
                @else
                    <i class="fa fa-filter" aria-hidden="true"></i>
                @endif {{ $title ?? '' }}
            </a>
        </h3>
    </div>
    @php
        if (isMobile()) {
            $closed = true;
        }
        $closed = true;
    @endphp
    <div id="collapseFilter" class="panel-collapse active collapse @if (empty($closed)) in @endif tw-pt-4 tw-pb-4"
        aria-expanded="true">
        <div class="box-body">
            {{ $slot }}
        </div>
    </div>
</div>
