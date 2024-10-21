@extends('layouts.layout')

@section('title', 'Stripe Payment')

@section('content')
    <h1>Stripe Payment for Order #{{ $order['id'] }}</h1>

    <form id="payment-form">
        @csrf
        <input type="hidden" id="email" value="{{ $order['user']['email'] }}">
        <input type="hidden" id="amount" value="{{ $order['total_amount'] }}">
        <input type="hidden" id="order_id" value="{{ $order['id'] }}">
        <input type="hidden" id="gateway" value="stripe">
        <div id="card-element"></div>
        <button type="submit">Pay Now</button>
    </form>

    <div id="message-modal" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header" id="modal-header-text"></div>
            <div class="modal-body" id="modal-body-text"></div>
            <button class="close-btn" onclick="closeModal()">Close</button>
        </div>
    </div>

    <div id="loading-overlay" class="loading-overlay" style="display: none;">
        <div class="loader"></div>
    </div>
@endsection

@section('scripts')
    <script>
        const stripeKey = '{{ config('services.stripe.key') }}';
        const paymentCreateUrl = '{{ route('payment.process') }}';
        const csrfToken = '{{ csrf_token() }}';
    </script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('js/stripeCustom.js') }}"></script>
@endsection
