<div class="col-md-12">
    <div class="box box-solid payment_row bg-lightgray">
        @if ($removable)
            <div class="box-header">
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool remove_payment_row"><i
                            class="fa fa-times fa-2x"></i></button>
                </div>
            </div>
        @endif

        @if (!empty($payment_line['id']))
            {!! Form::hidden("payment[$row_index][payment_id]", $payment_line['id']) !!}
        @endif

        @php
            $pos_settings = !empty(session()->get('business.pos_settings')) ? json_decode(session()->get('business.pos_settings'), true) : [];
            $show_in_pos = '';
            if ($pos_settings['enable_cash_denomination_on'] == 'all_screens' || $pos_settings['enable_cash_denomination_on'] == 'pos_screen') {
                $show_in_pos = true;
            }
        @endphp

        <div class="box-body">
            @include('sale_pos.partials.payment_row_form', [
                'row_index' => $row_index,
                'payment_line' => $payment_line,
                'show_denomination' => true,
				'show_in_pos' => $show_in_pos
            ])
        </div>
    </div>
</div>
