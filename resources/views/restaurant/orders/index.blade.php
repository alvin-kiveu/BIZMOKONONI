@extends('layouts.restaurant')
@section('title', __( 'restaurant.orders' ))

@section('content')

<!-- Main content -->
<section class="content min-height-90hv no-print">
    
    <div class="row">
        <div class="col-md-12 text-center">
            <h3>@lang( 'restaurant.all_orders' ) @show_tooltip(__('lang_v1.tooltip_serviceorder'))</h3>
        </div>
        <div class="col-sm-12">
            <button type="button" class="tw-dw-btn tw-dw-btn-primary tw-text-white pull-right"
                    id="refresh_orders">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-refresh"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" /><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg>@lang('restaurant.refresh')
            </button>
        </div>
    </div>
    <br>
    <div class="row">
    @if(!$is_service_staff)
        @component('components.widget')
            <div class="col-sm-6">
                {!! Form::open(['url' => action([\App\Http\Controllers\Restaurant\OrderController::class, 'index']), 'method' => 'get', 'id' => 'select_service_staff_form' ]) !!}
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user-secret"></i>
                        </span>
                        {!! Form::select('service_staff', $service_staff, request()->service_staff, ['class' => 'form-control select2', 'placeholder' => __('restaurant.select_service_staff'), 'id' => 'service_staff_id']); !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        @endcomponent
    @endif
    @component('components.widget', ['title' => __( 'lang_v1.line_orders' )])
        <input type="hidden" id="orders_for" value="waiter">
        <div class="row" id="line_orders_div">
         @include('restaurant.partials.line_orders', array('orders_for' => 'waiter'))   
        </div>
        <div class="overlay hide">
          <i class="fas fa-sync fa-spin"></i>
        </div>
    @endcomponent

    @component('components.widget', ['title' => __( 'restaurant.all_your_orders' )])
        <input type="hidden" id="orders_for" value="waiter">
        <div class="row" id="orders_div">
         @include('restaurant.partials.show_orders', array('orders_for' => 'waiter'))   
        </div>
        <div class="overlay hide">
          <i class="fas fa-sync fa-spin"></i>
        </div>
    @endcomponent
    </div>
</section>
<!-- /.content -->

@endsection

@section('javascript')
    <script type="text/javascript">
        $('select#service_staff_id').change( function(){
            $('form#select_service_staff_form').submit();
        });
        $(document).ready(function(){
            $(document).on('click', 'a.mark_as_served_btn', function(e){
                e.preventDefault();
                swal({
                  title: LANG.sure,
                  icon: "info",
                  buttons: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var _this = $(this);
                        var href = _this.data('href');
                        $.ajax({
                            method: "GET",
                            url: href,
                            dataType: "json",
                            success: function(result){
                                if(result.success == true){
                                    refresh_orders();
                                    toastr.success(result.msg);
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });

            $(document).on('click', 'a.mark_line_order_as_served', function(e){
                e.preventDefault();
                swal({
                  title: LANG.sure,
                  icon: "info",
                  buttons: true,
                }).then((sure) => {
                    if (sure) {
                        var _this = $(this);
                        var href = _this.attr('href');
                        $.ajax({
                            method: "GET",
                            url: href,
                            dataType: "json",
                            success: function(result){
                                if(result.success == true){
                                    refresh_orders();
                                    toastr.success(result.msg);
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });

            $('.print_line_order').click( function(){
                let data = {
                    'line_id' : $(this).data('id'),
                    'service_staff_id' : $("#service_staff_id").val()
                };
                $.ajax({
                    method: "GET",
                    url: '/modules/print-line-order',
                    dataType: "json",
                    data: data,
                    success: function(result){
                        if (result.success == 1 && result.html_content != '') {
                            $('#receipt_section').html(result.html_content);
                            __print_receipt('receipt_section');
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            });
        });
    </script>
@endsection