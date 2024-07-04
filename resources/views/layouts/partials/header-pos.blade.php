<!-- default value -->
@php
    $go_back_url = action([\App\Http\Controllers\SellPosController::class, 'index']);
    $transaction_sub_type = '';
    $view_suspended_sell_url = action([\App\Http\Controllers\SellController::class, 'index']) . '?suspended=1';
    $pos_redirect_url = action([\App\Http\Controllers\SellPosController::class, 'create']);
@endphp

@if (!empty($pos_module_data))
    @foreach ($pos_module_data as $key => $value)
        @php
            if (!empty($value['go_back_url'])) {
                $go_back_url = $value['go_back_url'];
            }

            if (!empty($value['transaction_sub_type'])) {
                $transaction_sub_type = $value['transaction_sub_type'];
                $view_suspended_sell_url .= '&transaction_sub_type=' . $transaction_sub_type;
                $pos_redirect_url .= '?sub_type=' . $transaction_sub_type;
            }
        @endphp
    @endforeach
@endif
<input type="hidden" name="transaction_sub_type" id="transaction_sub_type" value="{{ $transaction_sub_type }}">
@inject('request', 'Illuminate\Http\Request')
<div class="col-md-12 no-print pos-header">
    <input type="hidden" id="pos_redirect_url" value="{{ $pos_redirect_url }}">

    {{-- <div class="row">
      
        <div class="col-md-6">
            <div class="m-6 mt-5" style="display: flex;">
                <p><strong>@lang('sale.location'): &nbsp;</strong>
                    @if (empty($transaction->location_id))
                        @if (count($business_locations) > 1)
                            <div style="width: 28%;margin-bottom: 5px;">
                                {!! Form::select(
                                    'select_location_id',
                                    $business_locations,
                                    $default_location->id ?? null,
                                    ['class' => 'form-control input-sm', 'id' => 'select_location_id', 'required', 'autofocus'],
                                    $bl_attributes,
                                ) !!}
                            </div>
                        @else
                            {{ $default_location->name }}
                        @endif
                    @endif

                    @if (!empty($transaction->location_id))
                        {{ $transaction->location->name }}
                    @endif &nbsp; <span class="curr_datetime">{{ @format_datetime('now') }}</span>
                    <i class="fa fa-keyboard hover-q text-muted" aria-hidden="true" data-container="body"
                        data-toggle="popover" data-placement="bottom" data-content="@include('sale_pos.partials.keyboard_shortcuts_details')"
                        data-html="true" data-trigger="hover" data-original-title="" title=""></i>
                </p>
            </div>
        </div>
        <div class="col-md-6">
            <a href="{{ $go_back_url }}" title="{{ __('lang_v1.go_back') }}"
                class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-info m-5 pull-right">
                <strong><i class="fa fa-backward fa-lg"></i></strong>
            </a>
            @if (!empty($pos_settings['inline_service_staff']))
                <button type="button" id="show_service_staff_availability"
                    title="{{ __('lang_v1.service_staff_availability') }}"
                    class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-primary btn-flat m-6 btn-xs m-5 pull-right"
                    data-container=".view_modal"
                    data-href="{{ action([\App\Http\Controllers\SellPosController::class, 'showServiceStaffAvailibility']) }}">
                    <strong><i class="fa fa-users fa-lg"></i></strong>
                </button>
            @endif

            @can('close_cash_register')
                <button type="button" id="close_register" title="{{ __('cash_register.close_register') }}"
                    class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-error m-5 btn-modal pull-right"
                    data-container=".close_register_modal"
                    data-href="{{ action([\App\Http\Controllers\CashRegisterController::class, 'getCloseRegister']) }}">
                    <strong><i class="fa fa-window-close fa-lg"></i></strong>
                </button>
            @endcan

            @if (!empty($pos_settings['inline_service_staff']) || (in_array('tables', $enabled_modules) || in_array('service_staff', $enabled_modules)))
                <button type="button"
                    class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-primary m-6 btn-xs m-5 pull-right popover-default"
                    id="service_staff_replacement" title="{{ __('restaurant.service_staff_replacement') }}"
                    data-toggle="popover" data-trigger="click"
                    data-content='<div class="m-8"><input type="text" class="form-control" placeholder="@lang('sale.invoice_no')" id="send_for_sell_service_staff_invoice_no"></div><div class="w-100 text-center"><button type="button" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-error" id="send_for_sercice_staff_replacement">@lang('lang_v1.send')</button></div>'
                    data-html="true" data-placement="bottom">
                    <strong><i class="fa fa-user-plus fa-lg"></i></strong>
                </button>
            @endif

            @can('view_cash_register')
                <button type="button" id="register_details" title="{{ __('cash_register.register_details') }}"
                    class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-success m-6 btn-xs m-5 btn-modal pull-right"
                    data-container=".register_details_modal"
                    data-href="{{ action([\App\Http\Controllers\CashRegisterController::class, 'getRegisterDetails']) }}">
                    <strong><i class="fa fa-briefcase fa-lg" aria-hidden="true"></i></strong>
                </button>
            @endcan

            <button title="@lang('lang_v1.calculator')" id="btnCalculator" type="button"
                class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-success pull-right m-5 btn-xs mt-10 popover-default"
                data-toggle="popover" data-trigger="click" data-content='@include('layouts.partials.calculator')' data-html="true"
                data-placement="bottom">
                <strong><i class="fa fa-calculator fa-lg" aria-hidden="true"></i></strong>
            </button>

            <button type="button"
                class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-error m-6 m-5 pull-right popover-default"
                id="return_sale" title="@lang('lang_v1.sell_return')" data-toggle="popover" data-trigger="click"
                data-content='<div class="m-8"><input type="text" class="form-control" placeholder="@lang('sale.invoice_no')" id="send_for_sell_return_invoice_no"></div><div class="w-100 text-center"><button type="button" class="tw-dw-btn tw-dw-btn-error tw-text-white tw-dw-btn-sm" id="send_for_sell_return">@lang('lang_v1.send')</button></div>'
                data-html="true" data-placement="bottom">
                <strong><i class="fas fa-undo fa-lg"></i></strong>
            </button>

            <button type="button" title="{{ __('lang_v1.full_screen') }}"
                class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-primary m-6 hidden-xs m-5 pull-right"
                id="full_screen">
                <strong><i class="fa fa-window-maximize fa-lg"></i></strong>
            </button>

            <button type="button" id="view_suspended_sales" title="{{ __('lang_v1.view_suspended_sales') }}"
                class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-yellow m-6 btn-xs m-5 btn-modal pull-right"
                data-container=".view_modal" data-href="{{ $view_suspended_sell_url }}">
                <strong><i class="fa fa-pause-circle fa-lg"></i></strong>
            </button>
            @if (empty($pos_settings['hide_product_suggestion']))
                <button type="button" title="{{ __('lang_v1.view_products') }}" data-placement="bottom"
                    class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-success m-6 btn-xs m-5 btn-modal pull-right tw-block md:tw-hidden"
                    data-toggle="modal" data-target="#mobile_product_suggestion_modal">
                    <strong><i class="fa fa-cubes fa-lg"></i></strong>
                </button>
            @endif

            @if (Module::has('Repair') && $transaction_sub_type != 'repair')
                @include('repair::layouts.partials.pos_header')
            @endif

            @if (in_array('pos_sale', $enabled_modules) && !empty($transaction_sub_type))
                @can('sell.create')
                    <a href="{{ action([\App\Http\Controllers\SellPosController::class, 'create']) }}"
                        title="@lang('sale.pos_sale')"
                        class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-success m-6 btn-xs m-5 pull-right">
                        <strong><i class="fa fa-th-large"></i> &nbsp; @lang('sale.pos_sale')</strong>
                    </a>
                @endcan
            @endif
            @can('expense.add')
                <button type="button" title="{{ __('expense.add_expense') }}" data-placement="bottom"
                    class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-primary m-6 btn-xs m-5 btn-modal pull-right"
                    id="add_expense">
                    <strong><i class="fa fas fa-minus-circle"></i> @lang('expense.add_expense')</strong>
                </button>
            @endcan

        </div>

    </div> --}}

    <div
        class="tw-flex tw-flex-col md:tw-flex-row tw-items-center tw-justify-between tw-shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] tw-bg-white tw-rounded-xl tw-mx-0 tw-mt-1 tw-mb-0 md:tw-mb-0 tw-p-3">
        <div class="tw-w-full md:tw-w-1/3">
            <div class="tw-flex tw-items-center tw-gap-2">
                <p><strong>@lang('sale.location'): &nbsp;</strong></p>
                <div style="width: 28%">
                    @if (empty($transaction->location_id))
                        @if (count($business_locations) > 1)
                            {!! Form::select(
                                'select_location_id',
                                $business_locations,
                                $default_location->id ?? null,
                                ['class' => 'form-control input-sm', 'id' => 'select_location_id', 'required', 'autofocus'],
                                $bl_attributes,
                            ) !!}
                        @else
                            {{ $default_location->name }}
                        @endif
                    @endif
                </div>
                <div
                    class="tw-hidden md:tw-block tw-bg-[#646EE4] hover:tw-bg-[#414aac] tw-py-1.5 tw-px-2 tw-rounded-md">
                    @if (!empty($transaction->location_id))
                        {{ $transaction->location->name }}
                    @endif &nbsp; <span
                        class="curr_datetime text-white tw-font-semibold">{{ @format_datetime('now') }}</span>
                    <i class="fa fa-keyboard hover-q text-white" aria-hidden="true" data-container="body"
                        data-toggle="popover" data-placement="bottom" data-content="@include('sale_pos.partials.keyboard_shortcuts_details')"
                        data-html="true" data-trigger="hover" data-original-title="" title=""></i>
                </div>

                @if (empty($pos_settings['hide_product_suggestion']))
                    <button type="button" title="{{ __('lang_v1.view_products') }}" data-placement="bottom"
                        class="tw-shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] tw-bg-white hover:tw-bg-white/60 tw-cursor-pointer tw-border-2 tw-flex tw-items-center tw-justify-center tw-rounded-md tw-w-8 tw-h-8 tw-text-gray-600 btn-modal pull-right tw-block md:tw-hidden"
                        data-toggle="modal" data-target="#mobile_product_suggestion_modal">
                        <strong><i class="fa fa-cubes fa-lg tw-text-[#00935F] !tw-text-sm"></i></strong>
                    </button>
                @endif

                <span class="tw-block md:tw-hidden">
                    <i class="fas hamburger fa-bars tw-mx-5"
                        onclick="document.getElementById('pos_header_more_options').classList.toggle('tw-hidden')"></i>
                </span>

            </div>
        </div>

        <div class="tw-w-full md:tw-w-2/3 !tw-p-0 tw-flex tw-items-center tw-justify-between tw-gap-4 tw-flex-col md:tw-flex-row tw-hidden md:tw-flex"
            id="pos_header_more_options">
            <a href="{{ $go_back_url }}" title="{{ __('lang_v1.go_back') }}"
                class="tw-shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] tw-bg-white hover:tw-bg-white/60 tw-cursor-pointer tw-border-2 tw-flex tw-items-center tw-justify-center tw-rounded-md md:tw-w-8 tw-w-auto tw-h-8 tw-text-gray-600 pull-right">
                <strong class="!tw-m-3">
                    <i class="fa fa-backward fa-lg fa fa-backward tw-fa-lg tw-text-[#009EE4] !tw-text-sm"></i>
                    <span class="tw-inline md:tw-hidden">{{ __('lang_v1.go_back') }}</span>
                </strong>
            </a>

            {{-- <a href="{{ $go_back_url }}" title="{{ __('lang_v1.go_back') }}"
              class="md:tw-hidden tw-shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] tw-bg-white hover:tw-bg-white/60 tw-cursor-pointer tw-border-2 tw-flex tw-items-center tw-justify-center tw-rounded-md md:tw-w-8 tw-w-auto tw-h-8 tw-text-gray-600 pull-right">
            <strong class="!tw-m-3">
                <i class="fa fa-backward fa-lg fa fa-backward tw-fa-lg tw-text-[#009EE4] !tw-text-sm"></i>
                <span class="tw-inline md:tw-hidden">{{ __('lang_v1.go_back') }}</span>
            </strong>
          </a> --}}

            @if (!isset($pos_settings['hide_recent_trans']) || $pos_settings['hide_recent_trans'] == 0)
                <button type="button"
                    class="md:tw-hidden tw-shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] tw-bg-white hover:tw-bg-white/60 tw-cursor-pointer tw-border-2 tw-flex tw-items-center tw-justify-center tw-rounded-md md:tw-w-8 tw-w-auto tw-h-8 tw-text-gray-600 pull-right"
                    data-toggle="modal" data-target="#recent_transactions_modal" id="recent-transactions">
                        <strong class="!tw-m-3">
                            <i class="fa fa-clock fa-lg tw-text-[#646EE4] !tw-text-sm"></i>
                            <span class="tw-inline md:tw-hidden">{{ __('lang_v1.recent_transactions') }}</span>
                        </strong>
                </button>
            @endif

            @if (!empty($pos_settings['inline_service_staff']))
                <button type="button" id="show_service_staff_availability"
                    title="{{ __('lang_v1.service_staff_availability') }}"
                    class="tw-shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] tw-bg-white hover:tw-bg-white/60 tw-cursor-pointer tw-border-2 tw-flex tw-items-center tw-justify-center tw-rounded-md md:tw-w-8 tw-w-auto tw-h-8 tw-text-gray-600 pull-right"
                    data-container=".view_modal"
                    data-href="{{ action([\App\Http\Controllers\SellPosController::class, 'showServiceStaffAvailibility']) }}">
                    <strong class="!tw-m-3">
                        <i class="fa fa-users fa-lg tw-text-[#646EE4] !tw-text-sm"></i>
                        <span class="tw-inline md:tw-hidden">{{ __('lang_v1.service_staff_availability') }}</span>
                    </strong>
                </button>
            @endif

            @can('close_cash_register')
                <button type="button" id="close_register" title="{{ __('cash_register.close_register') }}"
                    class="tw-shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] tw-bg-white hover:tw-bg-white/60 tw-cursor-pointer tw-border-2 tw-flex tw-items-center tw-justify-center tw-rounded-md md:tw-w-8 tw-w-auto tw-h-8 tw-text-gray-600 btn-modal pull-right"
                    data-container=".close_register_modal"
                    data-href="{{ action([\App\Http\Controllers\CashRegisterController::class, 'getCloseRegister']) }}">
                    <strong class="!tw-m-3">
                        <i class="fa fa-window-close fa-lg tw-text-[#EF4B53] !tw-text-sm"></i>
                        <span class="tw-inline md:tw-hidden">{{ __('cash_register.close_register') }}</span>
                    </strong>
                </button>
            @endcan

            @if (
                !empty($pos_settings['inline_service_staff']) ||
                    (in_array('tables', $enabled_modules) || in_array('service_staff', $enabled_modules)))
                <button type="button"
                    class="tw-shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] tw-bg-white hover:tw-bg-white/60 tw-cursor-pointer tw-border-2 tw-flex tw-items-center tw-justify-center tw-rounded-md md:tw-w-8 tw-w-auto tw-h-8 tw-text-gray-600 pull-right popover-default"
                    id="service_staff_replacement" title="{{ __('restaurant.service_staff_replacement') }}"
                    data-toggle="popover" data-trigger="click"
                    data-content='<div class="m-8"><input type="text" class="form-control" placeholder="@lang('sale.invoice_no')" id="send_for_sell_service_staff_invoice_no"></div><div class="w-100 text-center"><button type="button" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-error" id="send_for_sercice_staff_replacement">@lang('lang_v1.send')</button></div>'
                    data-html="true" data-placement="bottom">

                    <strong class="!tw-m-3">
                        <i class="fa fa-user-plus fa-lg tw-text-[#646EE4] !tw-text-sm"></i>
                        <span class="tw-inline md:tw-hidden">{{ __('restaurant.service_staff_replacement') }}</span>
                    </strong>
                </button>
            @endif

            @can('view_cash_register')
                <button type="button" id="register_details" title="{{ __('cash_register.register_details') }}"
                    class="tw-shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] tw-bg-white hover:tw-bg-white/60 tw-cursor-pointer tw-border-2 tw-flex tw-items-center tw-justify-center tw-rounded-md md:tw-w-8 tw-w-auto tw-h-8 tw-text-gray-600 btn-modal pull-right"
                    data-container=".register_details_modal"
                    data-href="{{ action([\App\Http\Controllers\CashRegisterController::class, 'getRegisterDetails']) }}">

                    <strong class="!tw-m-3">
                        <i class="fa fa-briefcase tw-fa-lg tw-text-[#00935F] !tw-text-sm" aria-hidden="true"></i>
                        <span class="tw-inline md:tw-hidden">{{ __('cash_register.register_details') }}</span>
                    </strong>
                </button>
            @endcan

            <button title="@lang('lang_v1.calculator')" id="btnCalculator" type="button"
                class="tw-shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] tw-bg-white hover:tw-bg-white/60 tw-cursor-pointer tw-border-2 tw-flex tw-items-center tw-justify-center tw-rounded-md md:tw-w-8 tw-w-auto tw-h-8 tw-text-gray-600 pull-right popover-default"
                data-toggle="popover" data-trigger="click" data-content='@include('layouts.partials.calculator')' data-html="true"
                data-placement="bottom">


                <strong class="!tw-m-3">
                    <i class="fa fa-calculator fa-lg tw-text-[#00935F] !tw-text-sm" aria-hidden="true"></i>
                    <span class="tw-inline md:tw-hidden">{{ __('lang_v1.calculator') }}</span>
                </strong>
            </button>

            <button type="button"
                class="tw-shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] tw-bg-white hover:tw-bg-white/60 tw-cursor-pointer tw-border-2 tw-flex tw-items-center tw-justify-center tw-rounded-md md:tw-w-8 tw-w-auto tw-h-8 tw-text-gray-600 pull-right pull-right popover-default"
                id="return_sale" title="@lang('lang_v1.sell_return')" data-toggle="popover" data-trigger="click"
                data-content='<div class="m-8"><input type="text" class="form-control" placeholder="@lang('sale.invoice_no')" id="send_for_sell_return_invoice_no"></div><div class="w-100 text-center"><button type="button" class="tw-dw-btn tw-dw-btn-error tw-text-white tw-dw-btn-sm" id="send_for_sell_return">@lang('lang_v1.send')</button></div>'
                data-html="true" data-placement="bottom">
                <strong class="!tw-m-3">
                    <i class="fas fa-undo fa-lg tw-text-[#EF4B53] !tw-text-sm"></i>
                    <span class="tw-inline md:tw-hidden">{{ __('lang_v1.sell_return') }}</span>
                </strong>
            </button>


            <button type="button" title="{{ __('lang_v1.full_screen') }}"
                class="tw-shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] tw-bg-white hover:tw-bg-white/60 tw-cursor-pointer tw-border-2 tw-flex tw-items-center tw-justify-center tw-rounded-md md:tw-w-8 tw-w-auto tw-h-8 tw-text-gray-600 pull-right"
                id="full_screen">
                <strong class="!tw-m-3">
                    <i class="fa fa-window-maximize fa-lg tw-text-[#646EE4] !tw-text-sm"></i>
                    <span class="tw-inline md:tw-hidden">Full Screen</span>
                </strong>
            </button>

            <button type="button" id="view_suspended_sales" title="{{ __('lang_v1.view_suspended_sales') }}"
                class="tw-shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] tw-bg-white hover:tw-bg-white/60 tw-cursor-pointer tw-border-2 tw-flex tw-items-center tw-justify-center tw-rounded-md md:tw-w-8 tw-w-auto tw-h-8 tw-text-gray-600 btn-modal pull-right"
                data-container=".view_modal" data-href="{{ $view_suspended_sell_url }}">
                <strong class="!tw-m-3">
                    <i class="fa fa-pause-circle fa-lg tw-text-[#A5ADBB] !tw-text-sm"></i>
                    <span class="tw-inline md:tw-hidden">{{ __('lang_v1.view_suspended_sales') }}</span>
                </strong>
            </button>


            @if (Module::has('Repair') && $transaction_sub_type != 'repair')
                @include('repair::layouts.partials.pos_header')
            @endif

            @if (in_array('pos_sale', $enabled_modules) && !empty($transaction_sub_type))
                @can('sell.create')
                    <a href="{{ action([\App\Http\Controllers\SellPosController::class, 'create']) }}"
                        title="@lang('sale.pos_sale')"
                        class="tw-shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] tw-bg-white hover:tw-bg-white/60 tw-cursor-pointer tw-border-2 tw-w-auto tw-h-auto tw-py-1 tw-px-4 tw-rounded-md pull-right">
                        <strong><i class="fa fa-th-large tw-text-[#00935F] !tw-text-sm"></i> &nbsp;
                            @lang('sale.pos_sale')</strong>
                    </a>
                @endcan
            @endif
            @can('expense.add')
                <button type="button" title="{{ __('expense.add_expense') }}" data-placement="bottom"
                    class="tw-shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] tw-bg-white hover:tw-bg-white/60 tw-cursor-pointer tw-border-2 tw-w-auto tw-h-auto tw-py-1 tw-px-4 tw-rounded-md btn-modal pull-right"
                    id="add_expense">
                    <strong><i class="fa fas fa-minus-circle"></i> @lang('expense.add_expense')</strong>
                </button>
            @endcan

        </div>
    </div>
</div>

<div class="modal fade" id="service_staff_modal" tabindex="-1" role="dialog"
    aria-labelledby="gridSystemModalLabel">
</div>
