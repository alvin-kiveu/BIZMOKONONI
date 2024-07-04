<script src="{{$jsDomain}}/applepay/v2/applepay.js"></script>
<script>
var mfApConfig = {
    sessionId: "{{$mfSession->SessionId}}", // Here you add the "SessionId" you receive from the InitiateSession endpoint.
    countryCode: "{{$mfSession->CountryCode}}", // Here, add your country code.
    amount: "{{$paymentMethods['ap']->GatewayData['GatewayTotalAmount']}}", // Add the invoice amount.
    currencyCode: "{{$paymentMethods['ap']->GatewayData['GatewayCurrency']}}", // Here, add your currency code.
    cardViewId: "mf-ap-element",
    callback: mfCallback
};

myFatoorahAP.init(mfApConfig);
</script>