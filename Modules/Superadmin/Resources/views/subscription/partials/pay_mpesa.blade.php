<?php
$accountNumber = 'BMK' . rand(100000, 999999);
$url = url('/');
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<div class="col-md-12">

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Mpesa Payment</h4>

            <form action="<?php echo url('/subscription/mpesapay'); ?>" method="POST">
                @csrf
                <input type="hidden" name="package_id" value="{{ $package->id }}">
                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="number" name="phone_number" class="form-control" placeholder="eg 0712345678">
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" name="amount" value="{{ (int) $package->price }}" class="form-control"
                        readonly>
                </div>
                <div class="form-group">
                    <label for="account_number">Account Number</label>
                    <input type="text" name="account_number" value="{{ $accountNumber }}" class="form-control"
                        readonly>
                </div>
                <button type="submit" class="btn btn-primary">Pay with Mpesa</button>
            </form>


            @if (session('checkout_id'))
                <script>
                    document.addEventListener('DOMContentLoaded', (event) => {
                        const checkoutId = "{{ session('checkout_id') }}";

                        Swal.fire({
                            title: '<strong>Processing Payment</strong>',
                            html: '<div style="font-size: 1.2em; color: #555;">Please wait...</div>',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                                verifyTransaction(checkoutId);
                            },
                            customClass: {
                                popup: 'custom-swal-popup',
                                title: 'custom-swal-title',
                                htmlContainer: 'custom-swal-html'
                            },
                            backdrop: `
                        rgba(0,0,123,0.4)
                        left top
                        no-repeat
                    `,
                            showClass: {
                                popup: 'animated fadeInDown faster'
                            },
                            hideClass: {
                                popup: 'animated fadeOutUp faster'
                            }
                        });

                        function verifyTransaction(checkoutId) {
                            const interval = setInterval(() => {
                                const url = "<?php echo $url; ?>";
                                axios.post(url + '/subscription/mpesa-verifypayment', {
                                        checkoutRequestID: checkoutId
                                    })
                                    .then(response => {
                                        console.log(response.data);
                                        if (response.data.status === 'success') {
                                            console.log(response.data.message);
                                            clearInterval(interval);
                                            Swal.fire('Success',
                                                'Payment verified successfully! Refreshing balance...',
                                                'success');
                                                console.log(url + '/subscription');
                                            setTimeout(() => {
                                              window.location.href = url + '/subscription';
                                            }, 100);
                                        } else if (response.data.status === 'failed') {
                                            console.log(response.data.message);
                                            if (response.data.message !== 'Unknown error' && response.data
                                                .message !== 'Pending') {
                                                Swal.fire('Failed', response.data.message, 'error');
                                                clearInterval(interval);
                                            }
                                        } else if (response.data.status === 'pending') {
                                            console.log('Payment still pending...');
                                        }
                                    })
                                    .catch(error => {
                                        clearInterval(interval);
                                        Swal.fire('Error', 'Something went wrong during verification!', 'error');
                                    });
                            }, 2000);
                        }
                    });
                </script>
            @endif

        </div>
    </div>
</div>
