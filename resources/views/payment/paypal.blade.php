@extends('layouts.layout')

@section('title', 'PayPal Payment')

@section('content')
    <h1>PayPal Payment</h1>

    <!-- Notification message for test viewers -->
    <div class="notification">
        <p>
            <strong>Note for Test Viewers:</strong> Structure is all setup for paypal as well but, I currently do not have a PayPal account and am facing issues with creating one due to country-specific restrictions.
            As a result, I was unable to obtain the API keys needed for PayPal integration. Therefore, the PayPal payment functionality is not fully implemented in this demo.
        </p>
    </div>

    <!-- PayPal form (still included for future integration) -->
    <div id="paypal-payment-form">
        <input type="email" id="email" placeholder="Email" required>
        <input type="number" id="amount" placeholder="Amount" required>
        <input type="hidden" id="gateway" value="paypal">
        <div id="paypal-button-container"></div>
    </div>

    <div id="message-modal" class="modal">
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
@endsection
