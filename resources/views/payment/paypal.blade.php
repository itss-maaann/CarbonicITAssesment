@extends('layouts.layout')

@section('title', 'PayPal Payment')

@section('content')
    <h1>PayPal Payment for Order #{{ $order['id'] }}</h1>

    <div class="notification">
        <p>
            <strong>Note for Test Viewers:</strong> Structure is all set up for PayPal as well, but I currently do not have a PayPal account and am facing issues with creating one due to country-specific restrictions.
            As a result, I was unable to obtain the API keys needed for PayPal integration. Therefore, the PayPal payment functionality is not fully implemented in this demo.
        </p>
    </div>

    <div id="paypal-button-container"></div>

    <div id="message-modal" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header" id="modal-header-text"></div>
            <div class="modal-body" id="modal-body-text"></div>
            <button class="close-btn" onclick="closeModal()">Close</button>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&currency=USD"></script>
    <script src="{{ asset('js/paypalCustom.js') }}"></script>

    <script>
        function closeModal() {
            const messageModal = document.getElementById('message-modal');
            messageModal.style.display = 'none';
        }

        function showModal(header, body) {
            const messageModal = document.getElementById('message-modal');
            document.getElementById('modal-header-text').innerText = header;
            document.getElementById('modal-body-text').innerText = body;
            messageModal.style.display = 'flex';
        }

        paypal.Buttons({
            createOrder: function(data, actions) {
                const email = document.getElementById('email').value;
                const amount = document.getElementById('amount').value;

                if (!email || !amount) {
                    alert('Please enter both email and amount.');
                    return;
                }

                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: amount
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    showModal('Payment Successful', 'Transaction completed by ' + details.payer.name.given_name);
                });
            },
            onError: function(err) {
                console.error('PayPal Error:', err);
                showModal('Payment Error', 'There was an error processing the payment. Please try again.');
            }
        }).render('#paypal-button-container');
    </script>
@endsection
