@foreach($paymentMethods['cards'] as $mfCard)
@php($mfCardTitle = App::isLocale('ar') ? $mfCard->PaymentMethodAr : $mfCard->PaymentMethodEn)
<div class="mf-card-container mf-div-{{$mfCard->PaymentMethodCode}}" onclick="mfCardSubmit('{{$mfCard->PaymentMethodId}}')">
    <div class="mf-row-container">
        <img class="mf-payment-logo" src="{{$mfCard->ImageUrl}}" alt="{{$mfCardTitle}}">
        <span class="mf-payment-text mf-card-title">{{$mfCardTitle}}</span>
    </div>
    <span class="mf-payment-text">
        {{ $mfCard->GatewayData['GatewayTotalAmount'] }} {{ $mfCard->GatewayData['GatewayCurrency'] }}
    </span>
</div>
@endforeach

<script>
    function mfCardSubmit(pmid){
        window.location.href = "{{url('myfatoorah')}}?pmid=" + pmid;
    }
</script>
