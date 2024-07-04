<tr>
	<td>{{$product->name}} ({{$product->sku}})</td>
	<input type="hidden" name="products[]" value="{{$product->id}}">
	<td><button type="button" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline  tw-dw-btn-error remove_modifier_product"><i class="fa fa-times"></i></button></td>
</tr>