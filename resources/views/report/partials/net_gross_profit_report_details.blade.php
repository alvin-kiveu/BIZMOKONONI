<h3 class="text-muted mb-0">
    {{ __('lang_v1.gross_profit') }}: 
    <span class="display_currency" data-currency_symbol="true">{{$data['gross_profit']}}</span>
</h3>
<small class="help-block">
    (@lang('lang_v1.total_sell_price') - @lang('lang_v1.total_purchase_price'))
    @if(!empty($data['gross_profit_label']))
        {{-- + {{$data['gross_profit_label']}} --}}
        @foreach ($data['gross_profit_label'] as $val)
            + {{$val}}
        @endforeach
    @endif
</small>

<h3 class="text-muted mb-0">
    {{ __('report.net_profit') }}: 
    <span class="display_currency" data-currency_symbol="true">{{$data['net_profit']}}</span>
</h3>
<small class="help-block">@lang('lang_v1.gross_profit') + (@lang('lang_v1.total_sell_shipping_charge') + @lang('lang_v1.sell_additional_expense') + @lang('report.total_stock_recovered') + @lang('lang_v1.total_purchase_discount') + @lang('lang_v1.total_sell_round_off') 
@foreach($data['right_side_module_data'] as $module_data)
    @if(!empty($module_data['add_to_net_profit']))
        + {{$module_data['label']}} 
    @endif
@endforeach
) <br> - ( @lang('report.total_stock_adjustment') + @lang('report.total_expense') + @lang('lang_v1.total_purchase_shipping_charge') + @lang('lang_v1.total_transfer_shipping_charge') + @lang('lang_v1.purchase_additional_expense') + @lang('lang_v1.total_sell_discount') + @lang('lang_v1.total_reward_amount') 
@foreach($data['left_side_module_data'] as $module_data)
    @if(!empty($module_data['add_to_net_profit']))
        + {{$module_data['label']}}
    @endif 
@endforeach )</small>