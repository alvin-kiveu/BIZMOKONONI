@extends('layouts.app')
@section('title', __('lang_v1.gst_sales_report'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">{{ __('lang_v1.gst_sales_report')}}</h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <div class="row">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('gst_report_customer_filter', __('contact.customer') . ':') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </span>
                            {!! Form::select('customer_id', $customers, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'id' => 'gst_report_customer_filter']); !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('gst_sr_date_filter', __('report.date_range') . ':') !!}
                        {!! Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'gst_sr_date_filter', 'readonly']); !!}
                    </div>
                </div>
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" 
                id="gst_sales_report" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>@lang('sale.invoice_no')</th>
                            <th>@lang('sale.customer_name')</th>
                            <th>@lang('lang_v1.gstin_of_cutomer')<br><small>{{__('contact.tax_no')}}</small></th>
                            <th>@lang('lang_v1.invoice_date')</th>
                            <th>@lang('lang_v1.hsn_code') <br><small>{{__( 'category.code' )}}</small></th>
                            <th>GST%</th>
                            <th>@lang('sale.qty')</th>
                            <th>@lang('sale.unit_price')</th>
                            <th>@lang('sale.discount')</th>
                            <th>@lang('lang_v1.taxable_value')</th>
                            @foreach($taxes as $tax)
                                <th>
                                    {{$tax['name']}}
                                </th>
                            @endforeach
                            <th>@lang('sale.total')</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-gray font-17 footer-total text-center">
                            <td colspan="9"><strong>@lang('sale.total'):</strong></td>
                            <td class="total_taxable_value"></td>
                            @foreach($taxes as $tax)
                                <td class="tax_{{$tax['id']}}_total">
                                </td>
                            @endforeach
                            <td class="line_total"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready( function(){
            dateRangeSettings.startDate = moment().startOf('month');
            dateRangeSettings.endDate = moment().endOf('month');
            $('#gst_sr_date_filter').daterangepicker(
                dateRangeSettings, 
                function(start, end) {
                    $('#gst_sr_date_filter').val(
                        start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
                    );
                    gst_sales_report.ajax.reload();
                }
            );
            $('#gst_sr_date_filter').on('cancel.daterangepicker', function(ev, picker) {
                $('#gst_sr_date_filter').val('');
                gst_sales_report.ajax.reload();
            });

            $('#gst_report_customer_filter').change(function() {
                gst_sales_report.ajax.reload();
            });
            gst_sales_report = $('table#gst_sales_report').DataTable({
                processing: true,
                serverSide: true,
                aaSorting: [[3, 'desc']],
                scrollY: "75vh",
                scrollX:        true,
                scrollCollapse: true,
                ajax: {
                    url: '/reports/gst-sales-report',
                    data: function(d) {
                        var start = '';
                        var end = '';

                        if ($('#gst_sr_date_filter').val()) {
                            start = $('input#gst_sr_date_filter')
                                .data('daterangepicker')
                                .startDate.format('YYYY-MM-DD');

                            end = $('input#gst_sr_date_filter')
                                .data('daterangepicker')
                                .endDate.format('YYYY-MM-DD');
                        }
                        d.start_date = start;
                        d.end_date = end;
                        d.customer_id = $('select#gst_report_customer_filter').val();
                    },
                },
                columns: [
                    { data: 'invoice_no', name: 't.invoice_no' },
                    { data: 'customer', name: 'c.name' },
                    { data: 'tax_number', name: 'c.tax_number' },
                    { data: 'transaction_date', name: 't.transaction_date' },
                    { data: 'short_code', name: 'cat.short_code' },
                    { data: 'tax_percent', name: 'tr.amount' },
                    { data: 'sell_qty', name: 'transaction_sell_lines.quantity' },
                    { data: 'unit_price', name: 'transaction_sell_lines.unit_price_before_discount' },
                    { data: 'discount_amount', name: 'transaction_sell_lines.line_discount_amount' },
                    { data: 'taxable_value', name: 'taxable_value', searchable: false },

                    @foreach($taxes as $tax)
                        { data: "tax_{{$tax['id']}}", searchable: false, orderable: false },
                    @endforeach

                    { data: 'line_total', name: 'line_total', searchable: false },
                ],
                "footerCallback": function ( row, data, start, end, display ) {
                    var total_taxable_value = 0;
                    var line_total = 0;

                    @foreach($taxes as $tax)
                        var tax_{{$tax['id']}}_total = 0;
                    @endforeach

                    for (var r in data){
                        total_taxable_value += $(data[r].taxable_value).data('orig-value') ? 
                        parseFloat($(data[r].taxable_value).data('orig-value')) : 0;

                        line_total += $(data[r].line_total).data('orig-value') ? 
                        parseFloat($(data[r].line_total).data('orig-value')) : 0;

                        @foreach($taxes as $tax)
                            tax_{{$tax['id']}}_total += $(data[r].tax_{{$tax['id']}}).data('orig-value') ? 
                            parseFloat($(data[r].tax_{{$tax['id']}}).data('orig-value')) : 0;
                        @endforeach
                    }

                    @foreach($taxes as $tax)
                        if (tax_{{$tax['id']}}_total !== 0) {
                            $('.tax_{{$tax["id"]}}_total').html(__currency_trans_from_en(tax_{{$tax['id']}}_total, false));
                        }
                    @endforeach

                    $('.total_taxable_value').html(__currency_trans_from_en(total_taxable_value, false));
                    $('.line_total').html(__currency_trans_from_en(line_total, false));
                },
            });
        })
    </script>
@endsection