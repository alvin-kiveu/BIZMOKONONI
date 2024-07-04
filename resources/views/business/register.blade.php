@extends('layouts.auth2')
@section('title', __('lang_v1.register'))

@section('content')

    <div class="col-md-8 col-xs-12 col-md-offset-2 tw-mt-6">
        <div
            class=" tw-p-2 sm:tw-p-3 tw-mb-4 tw-transition-all tw-duration-200  tw-bg-white tw-shadow-sm tw-rounded-xl tw-ring-1 tw-ring-gray-200">
            <div class="tw-flex tw-flex-col tw-gap-4 tw-dw-rounded-box tw-dw-p-6 tw-dw-max-w-md">
                <div class="tw-flex tw-flex-col rounded-2xl tw-dw-p-6 tw-dw-max-w-md text-center">
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" class="tw-ml-4 tw-mt-4 icon icon-tabler icon-tabler-circle-key-filled" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 2c5.523 0 10 4.477 10 10a10 10 0 0 1 -20 0c0 -5.523 4.477 -10 10 -10zm2 5a3 3 0 0 0 -2.98 2.65l-.015 .174l-.005 .176l.005 .176c.019 .319 .087 .624 .197 .908l.09 .209l-3.5 3.5l-.082 .094a1 1 0 0 0 0 1.226l.083 .094l1.5 1.5l.094 .083a1 1 0 0 0 1.226 0l.094 -.083l.083 -.094a1 1 0 0 0 0 -1.226l-.083 -.094l-.792 -.793l.585 -.585l.793 .792l.094 .083a1 1 0 0 0 1.403 -1.403l-.083 -.094l-.792 -.793l.792 -.792a3 3 0 1 0 1.293 -5.708zm0 2a1 1 0 1 1 0 2a1 1 0 0 1 0 -2z" stroke-width="0" fill="currentColor" />
                    </svg> --}}
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" class="tw-mr-3 tw-mt-1 icon icon-tabler icon-tabler-lock-up" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12.5 21h-5.5a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2h10a2 2 0 0 1 1.739 1.01" />
                        <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" />
                        <path d="M8 11v-4a4 4 0 1 1 8 0v4" />
                        <path d="M19 22v-6" />
                        <path d="M22 19l-3 -3l-3 3" />
                    </svg>
                    <h1 class="tw-dw-text-3xl tw-dw-font-bold"> {{ config('app.name', 'ultimatePOS') }} - @lang('business.register_and_get_started_in_minutes')</h1> --}}
                    <h1 class="tw-text-lg md:tw-text-xl tw-font-semibold tw-text-[#1e1e1e]">
                            {{ config('app.name', 'ultimatePOS') }}
                      </h1>
                      <h2 class="tw-text-sm tw-font-medium tw-text-gray-500">
                            @lang('business.register_and_get_started_in_minutes')
                      </h2>
                </div>
            {!! Form::open([
                'url' => route('business.postRegister'),
                'method' => 'post',
                'id' => 'business_register_form',
                'files' => true,
            ]) !!}
            @include('business.partials.register_form')
            {!! Form::hidden('package_id', $package_id) !!}
            {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.change_lang').click(function() {
                window.location = "{{ route('business.getRegister') }}?lang=" + $(this).attr('value');
            });
        })
    </script>
@endsection
