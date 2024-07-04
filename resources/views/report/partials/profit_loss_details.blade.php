<div class="col-md-6">
    @component('components.widget')
        @include('report.partials.opening_stock_report_table')
    @endcomponent
</div>

<div class="col-md-6">
    @component('components.widget')
        @include('report.partials.clossing_stock_report_table')
    @endcomponent
</div>
<br>
<div class="col-xs-12">
    @component('components.widget')
        @include('report.partials.net_gross_profit_report_details')
    @endcomponent
</div>
