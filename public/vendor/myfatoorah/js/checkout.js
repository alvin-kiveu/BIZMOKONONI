document.addEventListener('DOMContentLoaded', function () {

    if (window.ApplePaySession) {
        return;
    }

    //remove ap if registered
    document.getElementById('mf-ap-element')?.remove();

    var mfGpElement = document.getElementById('mf-gp-element');
    if (!mfGpElement) {
        document.getElementById('mf-or-cardsDivider')?.remove();
    }

    //remove ap as a card
    let mfDivAps = document.querySelectorAll('.mf-div-ap');
    mfDivAps.forEach(element => {
        element.remove();
    });

    //are there any cards left?
    var mfCardContainer = document.querySelectorAll('.mf-card-container');
    if (mfCardContainer.length === 0) {
        document.getElementById('mf-sectionCard')?.remove();
        if (!mfGpElement) {
            document.getElementById('mf-or-formDivider')?.remove();
        }

        if (!document.getElementById('mf-ap-element') && !document.getElementById('mf-gp-element') && !document.getElementById('mf-form-element')) {
            document.getElementById('mf-paymentGateways')?.remove();
            document.getElementById('mf-noPaymentGateways').style.display = 'block';
        }
    }
});

