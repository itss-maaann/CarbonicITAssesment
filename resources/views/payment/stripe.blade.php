@extends('layouts.layout')

@section('title', 'Stripe Payment')

@section('content')
    <h1>Stripe Payment</h1>

    <form id="payment-form">
        <input type="email" id="email" placeholder="Email" required>
        <input type="number" id="amount" placeholder="Amount" required>
        <input type="hidden" id="gatway" value="stripe" required>
        <div id="card-element"></div>
        <button type="submit">Pay Now</button>
    </form>

    <div id="message-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header" id="modal-header-text"></div>
            <div class="modal-body" id="modal-body-text"></div>
            <button class="close-btn" onclick="closeModal()">Close</button>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const stripeKey = '{{ config('services.stripe.key') }}';
        const paymentCreateUrl = '{{ route('payment.create') }}';
        const csrfToken = '{{ csrf_token() }}';
    </script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('js/stripeCustom.js') }}"></script>
@endsection
