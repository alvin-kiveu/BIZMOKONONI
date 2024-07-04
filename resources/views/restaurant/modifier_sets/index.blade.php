@extends('layouts.app')
@section('title', __('restaurant.modifiers'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">@lang( 'restaurant.modifier_sets' )
        <small class="tw-text-sm md:tw-text-base tw-text-gray-700 tw-font-semibold">@lang( 'restaurant.manage_your_modifiers' )</small>
    </h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">


    @component('components.widget')
    <div class="box-header">
        <h3 class="box-title">@lang( 'restaurant.all_your_modifiers' )</h3>
        @can('restaurant.create')
            <div class="box-tools">
                    <button class="tw-dw-btn tw-bg-gradient-to-r tw-from-indigo-600 tw-to-blue-500 tw-font-bold tw-text-white tw-border-none tw-rounded-full btn-modal"
                    data-href="{{action([\App\Http\Controllers\Restaurant\ModifierSetsController::class, 'create'])}}" 
                    data-container=".modifier_modal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 5l0 14" />
                        <path d="M5 12l14 0" />
                    </svg> @lang('messages.add')
                </button>
            </div>
        @endcan
    </div>
    <div class="box-body">
        @can('restaurant.view')
            <table class="table table-bordered table-striped" id="modifier_table">
                <thead>
                    <tr>
                        <th>@lang( 'restaurant.modifier_sets' )</th>
                        <th>@lang( 'restaurant.modifiers' )</th>
                        <th>@lang( 'restaurant.products' )</th>
                        <th>@lang( 'messages.action' )</th>
                    </tr>
                </thead>
            </table>
        @endcan
    </div>
    @endcomponent

    <div class="modal fade modifier_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->

@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function(){

            $(document).on('click', 'button.remove-modifier-row', function(e){
                $(this).closest('tr').remove();
            });

            $(document).on('submit', 'form#table_add_form', function(e){
                e.preventDefault();
                var data = $(this).serialize();

                $.ajax({
                    method: "POST",
                    url: $(this).attr("action"),
                    dataType: "json",
                    data: data,
                    success: function(result){
                        if(result.success == true){
                            $('div.modifier_modal').modal('hide');
                            toastr.success(result.msg);
                            modifier_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            });

            //Brands table
            var modifier_table = $('#modifier_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '/modules/modifiers',
                    columnDefs: [ {
                        "targets": [1,2, 3],
                        "orderable": false,
                        "searchable": false
                    } ],
                    columns: [
                        { data: 'name', name: 'name'  },
                        { data: 'variations', name: 'variations'},
                        { data: 'modifier_products', name: 'modifier_products'},
                        { data: 'action', name: 'action'}
                    ],
                });

            $(document).on('click', 'button.edit_modifier_button', function(){

                $( "div.modifier_modal" ).load( $(this).data('href'), function(){

                    $(this).modal('show');

                    $('form#edit_form').submit(function(e){
                        e.preventDefault();
                        var data = $(this).serialize();

                        $.ajax({
                            method: "POST",
                            url: $(this).attr("action"),
                            dataType: "json",
                            data: data,
                            success: function(result){
                                if(result.success == true){
                                    $('div.modifier_modal').modal('hide');
                                    toastr.success(result.msg);
                                    modifier_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    });
                });
            });

            $(document).on('click', 'button.delete_modifier_button', function(){
                swal({
                  title: LANG.sure,
                  text: LANG.confirm_delete_table,
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var href = $(this).data('href');
                        var data = $(this).serialize();

                        $.ajax({
                            method: "DELETE",
                            url: href,
                            dataType: "json",
                            data: data,
                            success: function(result){
                                if(result.success == true){
                                    toastr.success(result.msg);
                                    modifier_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });

            $(document).on('click', 'button.add-modifier-row', function(){
                $('table#add-modifier-table').append($(this).data('html'));
            });

            $(document).on('click', 'button.remove_modifier_product', function(){
                swal({
                  title: LANG.sure,
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $(this).closest('tr').remove();
                    }
                });
            });
            
        });
    </script>
@endsection