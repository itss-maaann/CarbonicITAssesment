{{-- index.blade.php --}}
@extends('layouts.layout')

@section('title', 'Select Payment Gateway')

@section('content')
    <h1>Select Payment Gateway</h1>

    <div id="gateway-form-container">
        <!-- Only select gateway, no email or amount -->
        <form id="gateway-form">
            @csrf
            <div>
                <label>Select Payment Gateway:</label><br>
                <input type="radio" id="stripe" name="gateway" value="stripe" checked>
                <label for="stripe">Stripe</label><br>
                <input type="radio" id="paypal" name="gateway" value="paypal">
                <label for="paypal">PayPal</label>
            </div>

            <button type="button" id="continue-button">Continue</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        const continueButton = document.getElementById('continue-button');

        continueButton.addEventListener('click', () => {
            const gateway = document.querySelector('input[name="gateway"]:checked').value;

            // Redirect to the appropriate payment form page based on the selected gateway
            if (gateway === 'stripe') {
                window.location.href = "/payment/stripe";
            } else if (gateway === 'paypal') {
                window.location.href = "/payment/paypal";
            }
        });
    </script>
@endsection
