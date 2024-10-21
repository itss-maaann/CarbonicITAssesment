@extends('layouts.layout')

@section('title', 'Place and View Orders')

@section('content')
    <div class="home-content">
        <h1>Place an Order</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div id="order-form-container">
            <form id="order-form" method="POST" action="{{ route('orders.store') }}">
                @csrf
                <input type="hidden" name="user_id" value="1">

                <div>
                    <label for="products">Select Products:</label>
                    <select name="products[]" id="products" multiple required>
                        @foreach($products as $product)
                            <option value="{{ $product['id'] }}">{{ $product['name'] }} ({{ $product['price'] }} USD)</option>
                        @endforeach
                    </select>
                </div>

                <div class="gateway-selection">
                    <label>Select Payment Gateway:</label>
                    <div class="payment-options">
                        <label for="stripe" class="payment-option">
                            <input type="radio" id="stripe" name="gateway" value="stripe" checked>
                            <span class="gateway-label">Stripe</span>
                        </label>
                        <label for="paypal" class="payment-option">
                            <input type="radio" id="paypal" name="gateway" value="paypal">
                            <span class="gateway-label">PayPal</span>
                        </label>
                    </div>
                </div>

                <button type="submit" class="continue-button">Proceed to Payment</button>
            </form>
        </div>

        <hr>

        <h2>Your Orders</h2>
        <div id="orders-container">
            @if(empty($orders))
                <p>No orders found.</p>
            @else
                @foreach($orders as $order)
                    <div class="order-item card">
                        <h3>Order #{{ $order['id'] }}</h3>
                        <p>Total Amount: ${{ $order['total_amount'] }}</p>
                        <p><strong>Status:</strong>
                            <span class="badge {{ $order['status'] == 'completed' ? 'badge-success' : 'badge-warning' }}">{{ ucfirst($order['status']) }}</span>
                        </p>
                        <ul>
                            @foreach($order['products'] as $product)
                                <li>{{ $product['name'] }} - ${{ $product['price'] }}</li>
                            @endforeach
                        </ul>
                        <p>Placed on: {{ \Carbon\Carbon::parse($order['created_at'])->format('M d, Y') }}</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
