@extends('layouts.layout')

@section('title', 'About Us')

@section('content')
    <div class="about-content">
        <h1>About Carbonic Assessment</h1>
        <p>Carbonic Assessment is a demonstration of how modern web applications integrate third-party services, specifically payment gateways like Stripe and PayPal. The application showcases best practices for integrating payment platforms into a Laravel application while maintaining a professional, responsive, and aesthetic user interface.</p>

        <h2>Key Objectives:</h2>
        <ul>
            <li>Provide a seamless and secure payment experience for users.</li>
            <li>Showcase how to handle payment processes with modern APIs like Stripe and PayPal.</li>
            <li>Demonstrate clean, professional code structure using Laravel’s best practices.</li>
        </ul>

        <h2>Technologies Used:</h2>
        <ul>
            <li>Laravel 10 (Backend Framework)</li>
            <li>Stripe Payment API (Payment Processing)</li>
            <li>PayPal API (Demonstration Only)</li>
            <li>Blade Templating Engine (Frontend)</li>
            <li>CSS for custom styling and responsive design</li>
            <li>JavaScript (AJAX and Client-side Payment Handling)</li>
        </ul>

        <h2>What You Can Do in This Application:</h2>
        <ul>
            <li>Make secure payments using Stripe’s payment gateway.</li>
            <li>View the preliminary setup for PayPal integration (full testing limited due to API access).</li>
            <li>Explore clean, responsive UI and smooth user experiences.</li>
            <li>Understand how to implement best practices for third-party API integrations in Laravel.</li>
        </ul>

        <h2>Important Notice:</h2>
        <p>
            Although the refund feature has been implemented for both Stripe and PayPal, full functionality for PayPal has not been tested due to account limitations.
            Stripe payments and refunds, however, are fully demonstrated and functional.
        </p>
    </div>
@endsection
