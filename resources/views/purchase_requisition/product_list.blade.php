<table>
@foreach($products as $product)
	@php
		$check_decimal = $product->allow_decimal;
		$check_decimal_second_unit = $product->su_allow_decimal;
	@endphp
	<tr data-variation_id="{{$product->variation_id}}">
		<td>
			{{$product->product}}
			@if($product->type == 'single')
			 ({{$product->sku}})
			@else
				- {{$product->product_variation}} - {{$product->variation}} ({{$product->sub_sku}})
			@endif
			<p class="help-block">@lang('report.current_stock'): {{@format_quantity($product->stock)}} {{$product->unit}}</p>
		</td>
		<td>{{@format_quantity($product->alert_quantity)}} {{$product->unit}}</td>
		<td>
			<div class="input-group">
				<input type="hidden" name="purchases[{{$product->variation_id}}][product_id]" 
                value="{{$product->product_id}}">
                <input type="hidden" name="purchases[{{$product->variation_id}}][variation_id]" 
                value="{{$product->variation_id}}">
				<input type="text" 
                name="purchases[{{$product->variation_id}}][quantity]" 
                value="0"
                class="form-control input-sm input_number mousetrap"
                required
				@if($check_decimal) 
					data-decimal=1 
				@else 
					data-decimal=0 
					data-rule-abs_digit="true" 
					data-msg-abs_digit="@lang('lang_v1.decimal_value_not_allowed')" 
				@endif>
            	<div class="input-group-addon">
            		{{$product->unit}}
            	</div>
			</div>

			@if(!empty($product->second_unit))
				<br>
				<label>@lang('lang_v1.second_quantity')</label>
				<div class="input-group">
					<input type="text" 
	                name="purchases[{{$product->variation_id}}][secondary_unit_quantity]" 
	                value="0"
	                class="form-control input-sm input_number mousetrap"
	                required
	                data-rule-abs_digit={{$check_decimal_second_unit}}
	                data-msg-abs_digit="{{__('lang_v1.decimal_value_not_allowed')}}">
	            	<div class="input-group-addon">
	            		{{$product->second_unit}}
	            	</div>
				</div>
			@endif
		</td>
		<td>
			<button type="button" class="btn btn-danger btn-xs remove_product_line"><i class="fas fa-times"></i></button>
		</td>
	</tr>
@endforeach
</table>