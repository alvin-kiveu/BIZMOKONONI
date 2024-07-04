@extends('layouts.restaurant')
@section('title', __('restaurant.kitchen'))

@section('content')
    <!-- Main content -->
    <section class="content min-height-90hv no-print">

        <div class="row">
            <div class="col-md-12 text-center">
                <h3>@lang('restaurant.all_orders') - @lang('restaurant.kitchen') @show_tooltip(__('lang_v1.tooltip_kitchen'))</h3>
            </div>
        </div>

        <div
            class="tw-mb-4 tw-transition-all lg:tw-col-span-2 tw-duration-200 tw-bg-white tw-shadow-sm tw-rounded-xl tw-ring-1 hover:tw-shadow-md hover:tw-translate-y-0.5 tw-ring-gray-200">
            <div class="tw-p-4 sm:tw-p-5">
                <div class="tw-flex tw-justify-end tw-gap-2.5">
                <button type="button" class="tw-dw-btn tw-dw-btn-primary tw-text-white pull-right"
                    id="refresh_orders">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-refresh"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" /><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg>@lang('restaurant.refresh')
                </button>
                </div>
                <div class="tw-flow-root tw-mt-5 tw-border-b tw-border-gray-200">
                    <div class="tw-mx-4 tw--my-2 tw-overflow-x-auto sm:tw--mx-5">
                        <div class="tw-inline-block tw-min-w-full tw-py-2 tw-align-middle sm:tw-px-5">
                            <input type="hidden" id="orders_for" value="kitchen">
                            <div class="row" id="orders_div">
                                @include('restaurant.partials.show_orders', ['orders_for' => 'kitchen'])
                            </div>
                            <div class="overlay hide">
                                <i class="fas fa-sync fa-spin"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->

@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', 'a.mark_as_cooked_btn', function(e) {
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
                            success: function(result) {
                                if (result.success == true) {
                                    toastr.success(result.msg);
                                    _this.closest('.order_div').remove();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
