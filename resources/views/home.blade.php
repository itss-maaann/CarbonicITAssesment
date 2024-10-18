@extends('layouts.layout')

@section('title', 'Home')

@section('content')
    <div class="home-content">
        <h1>Welcome to Carbonic Assessment</h1>
        <p>This application is designed to demonstrate modern payment gateway integrations using both Stripe and PayPal. Users can securely process payments using their credit or debit cards through Stripe, and PayPal integration is also set up for demonstration purposes.</p>

        <h2>Features of this Application:</h2>
        <ul>
            <li>Stripe Payment Gateway Integration</li>
            <li>PayPal Payment Gateway Integration (Demonstration)</li>
            <li>Secure Payment Processing with 3D Secure support</li>
            <li>Modern and Responsive User Interface</li>
            <li>Professional and Aesthetic Design</li>
            <li>Error handling and notifications with modal dialogs</li>
        </ul>

        <p>
            <strong>Note:</strong> The PayPal implementation is available for viewing but has not been fully tested due to API access limitations.
            Refund functionality is implemented for both Stripe and PayPal, but only the Stripe refund logic has been fully integrated and demonstrated.
        </p>

        <p>Feel free to explore the application and see how seamless the payment process is with Stripe and the preliminary setup for PayPal!</p>
    </div>
@endsection
