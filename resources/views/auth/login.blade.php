@extends('layouts.auth2')
@section('title', __('lang_v1.login'))
@inject('request', 'Illuminate\Http\Request')
@section('content')
    @php
        $username = old('username');
        $password = null;
        if (config('app.env') == 'demo') {
            $username = 'admin';
            $password = '123456';

            $demo_types = [
                'all_in_one' => 'admin',
                'super_market' => 'admin',
                'pharmacy' => 'admin-pharmacy',
                'electronics' => 'admin-electronics',
                'services' => 'admin-services',
                'restaurant' => 'admin-restaurant',
                'superadmin' => 'superadmin',
                'woocommerce' => 'woocommerce_user',
                'essentials' => 'admin-essentials',
                'manufacturing' => 'manufacturer-demo',
            ];

            if (!empty($_GET['demo_type']) && array_key_exists($_GET['demo_type'], $demo_types)) {
                $username = $demo_types[$_GET['demo_type']];
            }
        }
    @endphp
    <div class="row">
        <div class="col-md-4">
        @if (config('app.env') == 'demo')
        
                @component('components.widget', [
                    'class' => 'box-primary',
                    'header' =>
                        '<h4 class="text-center">Demo Shops <small><i> <br/>Demos are for example purpose only, this application <u>can be used in many other similar businesses.</u></i> <br/><b>Click button to login that business</b></small></h4>',
                ])
                    <a href="?demo_type=all_in_one" class="btn btn-app bg-olive demo-login" data-toggle="tooltip"
                        title="Showcases all feature available in the application."
                        data-admin="{{ $demo_types['all_in_one'] }}"> <i class="fas fa-star"></i> All In One</a>

                    <a href="?demo_type=pharmacy" class="btn bg-maroon btn-app demo-login" data-toggle="tooltip"
                        title="Shops with products having expiry dates." data-admin="{{ $demo_types['pharmacy'] }}"><i
                            class="fas fa-medkit"></i>Pharmacy</a>

                    <a href="?demo_type=services" class="btn bg-orange btn-app demo-login" data-toggle="tooltip"
                        title="For all service providers like Web Development, Restaurants, Repairing, Plumber, Salons, Beauty Parlors etc."
                        data-admin="{{ $demo_types['services'] }}"><i class="fas fa-wrench"></i>Multi-Service Center</a>

                    <a href="?demo_type=electronics" class="btn bg-purple btn-app demo-login" data-toggle="tooltip"
                        title="Products having IMEI or Serial number code." data-admin="{{ $demo_types['electronics'] }}"><i
                            class="fas fa-laptop"></i>Electronics & Mobile Shop</a>

                    <a href="?demo_type=super_market" class="btn bg-navy btn-app demo-login" data-toggle="tooltip"
                        title="Super market & Similar kind of shops." data-admin="{{ $demo_types['super_market'] }}"><i
                            class="fas fa-shopping-cart"></i> Super Market</a>

                    <a href="?demo_type=restaurant" class="btn bg-red btn-app demo-login" data-toggle="tooltip"
                        title="Restaurants, Salons and other similar kind of shops."
                        data-admin="{{ $demo_types['restaurant'] }}"><i class="fas fa-utensils"></i> Restaurant</a>
                    <hr>

                    <i class="icon fas fa-plug"></i> Premium optional modules:<br><br>

                    <a href="?demo_type=superadmin" class="btn bg-red-active btn-app demo-login" data-toggle="tooltip"
                        title="SaaS & Superadmin extension Demo" data-admin="{{ $demo_types['superadmin'] }}"><i
                            class="fas fa-university"></i> SaaS / Superadmin</a>

                    <a href="?demo_type=woocommerce" class="btn bg-woocommerce btn-app demo-login" data-toggle="tooltip"
                        title="WooCommerce demo user - Open web shop in minutes!!" style="color:white !important"
                        data-admin="{{ $demo_types['woocommerce'] }}"> <i class="fab fa-wordpress"></i> WooCommerce</a>

                    <a href="?demo_type=essentials" class="btn bg-navy btn-app demo-login" data-toggle="tooltip"
                        title="Essentials & HRM (human resource management) Module Demo" style="color:white !important"
                        data-admin="{{ $demo_types['essentials'] }}">
                        <i class="fas fa-check-circle"></i>
                        Essentials & HRM</a>

                    <a href="?demo_type=manufacturing" class="btn bg-orange btn-app demo-login" data-toggle="tooltip"
                        title="Manufacturing module demo" style="color:white !important"
                        data-admin="{{ $demo_types['manufacturing'] }}">
                        <i class="fas fa-industry"></i>
                        Manufacturing Module</a>

                    <a href="?demo_type=superadmin" class="btn bg-maroon btn-app demo-login" data-toggle="tooltip"
                        title="Project module demo" style="color:white !important"
                        data-admin="{{ $demo_types['superadmin'] }}">
                        <i class="fas fa-project-diagram"></i>
                        Project Module</a>

                    <a href="?demo_type=services" class="btn btn-app demo-login" data-toggle="tooltip"
                        title="Advance repair module demo" style="color:white !important; background-color: #bc8f8f"
                        data-admin="{{ $demo_types['services'] }}">
                        <i class="fas fa-wrench"></i>
                        Advance Repair Module</a>

                    <a href="{{ url('docs') }}" target="_blank" class="btn btn-app" data-toggle="tooltip"
                        title="Advance repair module demo" style="color:white !important; background-color: #2dce89">
                        <i class="fas fa-network-wired"></i>
                        Connector Module / API Documentation</a>
                @endcomponent
            
            
        
    @endif
        </div>
        <div class="col-md-4">
            <div
                class="tw-p-5 md:tw-p-6 tw-mb-4 tw-rounded-2xl tw-transition-all tw-duration-200 tw-bg-white tw-shadow-sm tw-ring-1 tw-ring-gray-200">
                <div class="tw-flex tw-flex-col tw-gap-4 tw-dw-rounded-box tw-dw-p-6 tw-dw-max-w-md">
                    <div class="tw-flex tw-items-center tw-flex-col">
                        <h1 class="tw-text-lg md:tw-text-xl tw-font-semibold tw-text-[#1e1e1e]">
                            @lang('lang_v1.welcome_back')
                        </h1>
                        <h2 class="tw-text-sm tw-font-medium tw-text-gray-500">
                            @lang('lang_v1.login_to_your') {{ config('app.name', 'ultimatePOS') }}
                        </h2>
                    </div>

                    <form method="POST" action="{{ route('login') }}" id="login-form">
                        {{ csrf_field() }}
                        <div class="form-group has-feedback {{ $errors->has('username') ? ' has-error' : '' }}">
                            <label class="tw-dw-form-control">
                                <div class="tw-dw-label">
                                    <span
                                        class="tw-text-xs md:tw-text-sm tw-font-medium tw-text-black">@lang('Username')</span>
                                </div>

                                <input
                                    class="tw-border tw-border-[#D1D5DA] tw-outline-none tw-h-12 tw-bg-transparent tw-rounded-lg tw-px-3 tw-font-medium tw-text-black placeholder:tw-text-gray-500 placeholder:tw-font-medium"
                                    name="username" required autofocus placeholder="@lang('lang_v1.username')"
                                    data-last-active-input="" id="username" type="text" name="username"
                                    value="{{ $username }}" />
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </label>
                        </div>

                        <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="tw-dw-form-control">
                                <div class="tw-dw-label">
                                    <span
                                        class="tw-text-xs md:tw-text-sm tw-font-medium tw-text-black">@lang('Password')</span>
                                    @if (config('app.env') != 'demo')
                                        <a href="{{ route('password.request') }}"
                                            class="tw-text-xs md:tw-text-sm tw-font-medium tw-bg-gradient-to-r tw-from-indigo-500 tw-to-blue-500 tw-inline-block tw-text-transparent tw-bg-clip-text hover:tw-text-[#467BF5]"
                                            tabindex="-1">@lang('lang_v1.forgot_your_password')</a>
                                    @endif
                                </div>

                                <input
                                    class="tw-border tw-border-[#D1D5DA] tw-outline-none tw-h-12 tw-bg-transparent tw-rounded-lg tw-px-3 tw-font-medium tw-text-black placeholder:tw-text-gray-500 placeholder:tw-font-medium"
                                    id="password" type="password" name="password" value="{{ $password }}" required
                                    placeholder="@lang('lang_v1.password')" />
                            </label>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="tw-dw-form-control">
                            <label class="tw-dw-cursor-pointer tw-dw-label tw-self-start tw-gap-2">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}
                                    class="tw-dw-checkbox">
                                <span
                                    class="tw-text-xs md:tw-text-sm tw-font-medium tw-text-black tw-mt-[0.2rem]">@lang('lang_v1.remember_me')</span>
                            </label>
                        </div>

                        <button type="submit"
                            class="tw-bg-gradient-to-r tw-from-indigo-500 tw-to-blue-500 tw-h-12 tw-rounded-xl tw-text-sm md:tw-text-base tw-text-white tw-font-semibold tw-w-full tw-max-w-full mt-2 hover:tw-from-indigo-600 hover:tw-to-blue-600 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-blue-500 focus:tw-ring-offset-2 active:tw-from-indigo-700 active:tw-to-blue-700">
                            @lang('lang_v1.login')
                        </button>
                    </form>

                    <div class="tw-flex tw-items-center tw-flex-col">
                        <!-- Register Url -->

                        @if (!($request->segment(1) == 'business' && $request->segment(2) == 'register'))
                            <!-- Register Url -->
                            @if (config('constants.allow_registration'))
                                <a href="{{ route('business.getRegister') }}@if (!empty(request()->lang)) {{ '?lang=' . request()->lang }} @endif"
                                    class="tw-text-sm tw-font-medium tw-text-gray-500 hover:tw-text-gray-500 tw-mt-2">{{ __('business.not_yet_registered') }}
                                    <span
                                        class="tw-text-sm tw-font-medium tw-bg-gradient-to-r tw-from-indigo-500 tw-to-blue-500 tw-inline-block tw-text-transparent tw-bg-clip-text hover:tw-text-[#467BF5] hover:tw-underline">{{ __('business.register_now') }}</span></a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    
@stop
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.change_lang').click(function() {

                window.location = "{{ route('login') }}?lang=" + $(this).attr('value');
            });

            $('a.demo-login').click(function(e) {
                e.preventDefault();
                $('#username').val($(this).data('admin'));
                $('#password').val("{{ $password }}");
                $('form#login-form').submit();
            });
        })
    </script>
@endsection
