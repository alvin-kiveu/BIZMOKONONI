<div class="col-md-12">
    <br>
	<p class="help-block">{!! nl2br($offline_payment_details) ?? '' !!}</p>
	<br>
<!--	<p class="help-block">@lang('superadmin::lang.offline_pay_helptext')</p>-->
	<form action="{{action('\Modules\Superadmin\Http\Controllers\SubscriptionController@confirm', [$package->id])}}" method="POST">
	 	{{ csrf_field() }}
	 	<input type="hidden" name="gateway" value="{{$k}}">

	 	<button type="submit" class="btn btn-success"> <i class="fas fa-handshake"></i> Confirm Payment</button>
	</form>
</div>