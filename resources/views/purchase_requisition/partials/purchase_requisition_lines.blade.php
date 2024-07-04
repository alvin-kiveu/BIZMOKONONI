@foreach($purchase_requisition->purchase_lines as $purchase_line)
	@if($purchase_line->quantity - $purchase_line->po_quantity_purchased > 0)
		@include('purchase.partials.purchase_entry_row', [
			'variations' => [$purchase_line->variations],
			'product' => $purchase_line->product,
			'row_count' => $row_count,
			'variation_id' => $purchase_line->variation_id,
			'taxes' => $taxes,
			'currency_details' => $currency_details,
			'hide_tax' => $hide_tax,
			'sub_units' => $sub_units_array[$purchase_line->id],
			'purchase_requisition_line' => $purchase_line,
			'purchase_requisition' => $purchase_requisition
		])
		@php
			$row_count++;
		@endphp
	@endif
@endforeach