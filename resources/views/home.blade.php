@extends('layouts.layout')

@section('title', 'Home')

@section('content')
    <div class="home-content">
        <h1>Welcome to Carbonic Assessment</h1>
        <p>This application is built to showcase how third-party API integrations, particularly payment gateways like Stripe and PayPal, can be seamlessly integrated into a Laravel application. It demonstrates secure payment processing, error handling, and clean, maintainable code using design patterns.</p>

        <h2>What’s Included:</h2>
        <ul>
            <li><strong>Stripe Integration</strong>: Fully functional, allowing secure payments with 3D Secure support.</li>
            <li><strong>PayPal Integration</strong>: Available for demonstration, though not fully implemented due to limitations in obtaining API keys.</li>
            <li><strong>Repository and Service Layer Design Patterns</strong>: Used for clean code architecture, managing API interactions.</li>
            <li><strong>Modern UI/UX</strong>: A responsive and user-friendly interface, developed with Blade templates and custom CSS.</li>
            <li><strong>Error Handling with Modals</strong>: Notifications and errors are handled via modals for a smooth user experience.</li>
        </ul>

        <p>
            <strong>Note:</strong> The Stripe integration is fully functional and covers the complete payment flow. PayPal integration is in a demonstration phase due to account restrictions in Pakistan, and refund functionality is implemented conceptually but not fully integrated in the frontend.
        </p>

        <p>
            The application also demonstrates how to effectively structure a Laravel project for scalability and maintainability, showcasing clean Eloquent relationships and API syncing. Feel free to explore the app, initiate payments, and view the elegant UI designed for a seamless experience!
        </p>
    </div>
@endsection
