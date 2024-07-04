<div class="row">
    <div class="option-div-group">
        <div class="col-md-12">
            <label class="form-check-label" for="sku">@lang('product.variation_sku_format') </label>@show_tooltip(__('product.variation_sku_format_help_text'))
        </div>
            <div class="col-sm-4">
                <input class="form-check-input" type="radio" name="sku_type" checked id="with_out_variation" value="with_out_variation">
                <label class="form-check-label" for="with_out_variation">@lang('product.sku_number')</label>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <input class="form-check-input" type="radio" name="sku_type" id="with_variation"
                        value="with_variation">
                    <label class="form-check-label" for="with_variation">@lang('product.sku_variation_number')</label>
                </div>
            </div>
    </div>
</div>


<div class="col-sm-12">
    <h4>@lang('product.add_variation'):* <button type="button" class="tw-dw-btn tw-dw-btn-primary tw-text-white tw-dw-btn-sm" id="add_variation"
            data-action="add">+</button></h4>
</div>
<div class="col-sm-12">
    <div class="table-responsive">
        <table class="table table-bordered add-product-price-table table-condensed" id="product_variation_form_part">
            <thead>
                <tr>
                    <th></th>
                    <th class="col-sm-2">@lang('lang_v1.variation')</th>
                    <th class="col-sm-10">@lang('product.variation_values')</th>
                </tr>
            </thead>
            <tbody>
                @if ($action == 'add')
                    @include('product.partials.product_variation_row', ['row_index' => 0])
                @else
                    @forelse ($product_variations as $product_variation)
                        @include('product.partials.edit_product_variation_row', [
                            'row_index' => $action == 'edit' ? $product_variation->id : $loop->index,
                        ])
                    @empty
                        @include('product.partials.product_variation_row', ['row_index' => 0])
                    @endforelse

                @endif

            </tbody>
        </table>
    </div>
</div>
