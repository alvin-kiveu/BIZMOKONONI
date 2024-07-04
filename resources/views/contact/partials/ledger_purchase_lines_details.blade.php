<table class="table table-slim mb-0 bg-light-gray" @if(!empty($for_pdf)) style="width: 100%;" @endif>
        <tr>
        <th>#</th>
        <th>@lang('sale.product')</th>
        <th>{{ __('sale.qty') }}</th>
        <th>{{ __('sale.unit_price') }}</th>
        <th>@lang( 'lang_v1.discount_percent' )</th>
        <th>@lang('sale.tax')</th>
        <th>{{ __('sale.price_inc_tax') }}</th>
        <th>@lang('sale.subtotal')</th>
        </tr>
  @foreach($purchase->purchase_lines as $purchase_line)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>
        {{ $purchase_line->product->name }}
         @if( $purchase_line->product->type == 'variable')
          - {{ $purchase_line->variations->product_variation->name}}
          - {{ $purchase_line->variations->name}}
         @endif
         - {{ $purchase_line->variations->sub_sku ?? ''}}
      </td>
          
      <td>{{@format_quantity($purchase_line->quantity)}} @if(!empty($purchase_line->sub_unit)) {{$purchase_line->sub_unit->short_name}} @else {{$purchase_line->product->unit->short_name}} @endif
      </td>
      <td >@format_currency($purchase_line->pp_without_discount)</td>
      <td >{{@num_format($purchase_line->discount_percent)}} %</td>
      <td >@format_currency($purchase_line->item_tax)</td>
      <td >@format_currency($purchase_line->purchase_price_inc_tax)</span></td>
      <td >@format_currency($purchase_line->purchase_price_inc_tax * $purchase_line->quantity)</td>
    </tr>
  @endforeach
</table>