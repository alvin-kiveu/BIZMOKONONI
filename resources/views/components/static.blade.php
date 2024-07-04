<div
    class="tw-mb-4 tw-transition-all tw-duration-200 tw-bg-white tw-shadow-sm hover:tw-shadow-md tw-rounded-xl hover:tw-translate-y-0.5 tw-ring-1 tw-ring-gray-200">
    <div class="tw-p-4 sm:tw-p-5">
        <div class="tw-flex tw-items-center tw-gap-4">
            @if (!empty($svg))
                <div
                    class="tw-inline-flex tw-items-center tw-justify-center tw-w-10 tw-h-10 tw-rounded-full sm:tw-w-12 sm:tw-h-12 tw-shrink-0 {{$svg_bg ?? 'tw-bg-sky-100'}} {{$svg_text ?? 'tw-text-sky-500'}} ">

                    {!! $svg !!}
                </div>
            @endif

            <div class="tw-flex-1 tw-min-w-0">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

