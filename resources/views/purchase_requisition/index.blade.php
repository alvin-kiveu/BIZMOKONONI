@extends('layouts.app')
@section('title', __('lang_v1.purchase_requisition'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header no-print">
        <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">@lang('lang_v1.purchase_requisition')<br>
            <small class="tw-text-sm md:tw-text-base tw-text-gray-700 tw-font-semibold">@lang('lang_v1.purchase_requisition_help_text')</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content no-print">
        @component('components.filters', ['title' => __('report.filters')])
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('pr_list_filter_location_id', __('purchase.business_location') . ':') !!}
                    {!! Form::select('pr_list_filter_location_id', $business_locations, null, [
                        'class' => 'form-control select2',
                        'style' => 'width:100%',
                        'placeholder' => __('lang_v1.all'),
                    ]) !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('pr_list_filter_status', __('sale.status') . ':') !!}
                    {!! Form::select('pr_list_filter_status', $purchaseRequisitionStatuses, null, [
                        'class' => 'form-control select2',
                        'style' => 'width:100%',
                        'placeholder' => __('lang_v1.all'),
                    ]) !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('po_list_filter_date_range', __('report.date_range') . ':') !!}
                    {!! Form::text('po_list_filter_date_range', null, [
                        'placeholder' => __('lang_v1.select_a_date_range'),
                        'class' => 'form-control',
                        'readonly',
                    ]) !!}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('pr_list_filter_required_by_date', __('lang_v1.required_by_date') . ':') !!}
                    {!! Form::text('pr_list_filter_required_by_date', null, [
                        'placeholder' => __('lang_v1.select_a_date_range'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </div>
        @endcomponent
        @component('components.widget', ['class' => 'box-primary'])
            @can('purchase_requisition.create')
                @slot('tool')
                    <div class="box-tools">
                        {{-- <a class="btn btn-block btn-primary" href="{{action([\App\Http\Controllers\PurchaseRequisitionController::class, 'create'])}}">
                    <i class="fa fa-plus"></i> @lang('messages.add')</a> --}}
                        <a class="tw-dw-btn tw-bg-gradient-to-r tw-from-indigo-600 tw-to-blue-500 tw-font-bold tw-text-white tw-border-none tw-rounded-full"
                            href="{{action([\App\Http\Controllers\PurchaseRequisitionController::class, 'create'])}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg> @lang('messages.add')
                        </a>
                    </div>
                @endslot
            @endcan

            <table class="table table-bordered table-striped ajax_view" id="purchase_requisition_table" style="width: 100%;">
                <thead>
                    <tr>
                        <th>@lang('messages.action')</th>
                        <th>@lang('messages.date')</th>
                        <th>@lang('purchase.ref_no')</th>
                        <th>@lang('purchase.location')</th>
                        <th>@lang('sale.status')</th>
                        <th>@lang('lang_v1.required_by_date')</th>
                        <th>@lang('lang_v1.added_by')</th>
                    </tr>
                </thead>
            </table>
        @endcomponent
    </section>
    <!-- /.content -->
@stop
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            //Purchase table
            purchase_requisition_table = $('#purchase_requisition_table').DataTable({
                processing: true,
                serverSide: true,
                aaSorting: [
                    [1, 'desc']
                ],
                scrollY: "75vh",
                scrollX: true,
                scrollCollapse: true,
                ajax: {
                    url: '{{ action([\App\Http\Controllers\PurchaseRequisitionController::class, 'index']) }}',
                    data: function(d) {
                        if ($('#pr_list_filter_location_id').length) {
                            d.location_id = $('#pr_list_filter_location_id').val();
                        }
                        d.status = $('#pr_list_filter_status').val();

                        var start = '';
                        var end = '';
                        if ($('#po_list_filter_date_range').val()) {
                            start = $('input#po_list_filter_date_range')
                                .data('daterangepicker')
                                .startDate.format('YYYY-MM-DD');
                            end = $('input#po_list_filter_date_range')
                                .data('daterangepicker')
                                .endDate.format('YYYY-MM-DD');
                        }
                        d.start_date = start;
                        d.end_date = end;

                        if ($('#pr_list_filter_required_by_date').val()) {
                            required_by_start = $('input#pr_list_filter_required_by_date')
                                .data('daterangepicker')
                                .startDate.format('YYYY-MM-DD');
                            required_by_end = $('input#pr_list_filter_required_by_date')
                                .data('daterangepicker')
                                .endDate.format('YYYY-MM-DD');

                            d.required_by_start = required_by_start;
                            d.required_by_end = required_by_end;
                        }

                        d = __datatable_ajax_callback(d);
                    },
                },
                columns: [{
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'transaction_date',
                        name: 'transaction_date'
                    },
                    {
                        data: 'ref_no',
                        name: 'ref_no'
                    },
                    {
                        data: 'location_name',
                        name: 'BS.name'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'delivery_date',
                        name: 'delivery_date'
                    },
                    {
                        data: 'added_by',
                        name: 'u.first_name'
                    },
                ]
            });

            $(document).on(
                'change',
                '#pr_list_filter_location_id, #pr_list_filter_status',
                function() {
                    purchase_requisition_table.ajax.reload();
                }
            );

            $('#po_list_filter_date_range').daterangepicker(
                dateRangeSettings,
                function(start, end) {
                    $('#po_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(
                        moment_date_format));
                    purchase_requisition_table.ajax.reload();
                }
            );
            $('#po_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
                $('#po_list_filter_date_range').val('');
                purchase_requisition_table.ajax.reload();
            });
            dateRangeSettings.autoUpdateInput = false;
            $('#pr_list_filter_required_by_date').daterangepicker(
                dateRangeSettings,
                function(start, end) {
                    $('#pr_list_filter_required_by_date').val(start.format(moment_date_format) + ' ~ ' + end
                        .format(moment_date_format));
                    purchase_requisition_table.ajax.reload();
                }
            );
            $('#pr_list_filter_required_by_date').on('cancel.daterangepicker', function(ev, picker) {
                $('#pr_list_filter_required_by_date').val('');
                purchase_requisition_table.ajax.reload();
            });

            $(document).on('click', 'a.delete-purchase-requisition', function(e) {
                e.preventDefault();
                swal({
                    title: LANG.sure,
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then(willDelete => {
                    if (willDelete) {
                        var href = $(this).attr('href');
                        $.ajax({
                            method: 'DELETE',
                            url: href,
                            dataType: 'json',
                            success: function(result) {
                                if (result.success == true) {
                                    toastr.success(result.msg);
                                    purchase_requisition_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                        });
                    }
                });
            });
        });
    </script>
@endsection
