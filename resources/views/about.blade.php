@extends('layouts.layout')

@section('title', 'About Us')

@section('content')
    <div class="about-content">
        <h1>About Carbonic Assessment</h1>
        <p>Carbonic Assessment is a Laravel application designed to highlight modern best practices for integrating third-party services, including payment gateways like Stripe and PayPal. The project demonstrates how to implement these services using clean, scalable, and professional coding practices.</p>

        <h2>Key Features and Objectives:</h2>
        <ul>
            <li>Seamless payment processing through <strong>Stripe</strong> (fully functional) and <strong>PayPal</strong> (demonstration only).</li>
            <li>Implementation of <strong>Repository</strong> and <strong>Service Layer</strong> patterns to ensure a maintainable and testable codebase.</li>
            <li>Integration of complex <strong>Eloquent Relationships</strong> (One-to-Many and Many-to-Many) between users, orders, and products.</li>
            <li>Data syncing with external APIs generated from <a href="https://designer.mocky.io">Mockey</a>, transferring order and product data through background jobs.</li>
            <li>Third-party API integrations like Stripe for processing payments and retrieving statuses as well as syncing orders and products with mock external APIs.</li>
            <li>Use of factories for creating mock data for users, orders, produts etc</li>
            <li>Use of <strong>Laravel Jobs</strong> for syncing data in the background for a smooth user experience.</li>
            <li>Responsive, user-friendly frontend design using Blade, CSS, and AJAX for dynamic interactions.</li>
        </ul>

        <h2>Technologies Used:</h2>
        <ul>
            <li><strong>Laravel 10</strong>: Backend framework.</li>
            <li><strong>Stripe API</strong>: Full payment flow, including payment intent creation and confirmation.</li>
            <li><strong>PayPal API</strong>: Basic order setup, available for demonstration purposes only due to API access limitations.</li>
            <li><strong>Blade Templating Engine</strong>: For frontend rendering and templating.</li>
            <li><strong>JavaScript & AJAX</strong>: Handling client-side interactions and payment processing.</li>
            <li><strong>Laravel Jobs</strong>: For background processing, ensuring non-blocking payment flows.</li>
            <li><strong>CSS</strong>: Custom styling for a modern, responsive UI.</li>
        </ul>

        <h2>Core Functionalities:</h2>
        <ul>
            <li>Users can place orders by selecting products and proceeding with payments via Stripe or PayPal (demonstration).</li>
            <li>Background jobs ensure smooth payment processing, syncing data with external APIs.</li>
            <li>Complex relationships between users, orders, and products are managed using Laravel’s Eloquent ORM.</li>
            <li>Order history and payment details are displayed in a user-friendly format, with dynamic status updates for payments.</li>
        </ul>

        <h2>Integration Highlights:</h2>
        <p>The application integrates with Stripe and PayPal using <strong>Repository and Service Layer design patterns</strong> to manage API requests and responses in a clean and scalable way. For Stripe, the entire payment flow from creating a payment intent to confirming payments is demonstrated. PayPal is implemented as a demo but provides the necessary structure for future full integration.</p>

        <h2>Challenges and Limitations:</h2>
        <p>
            While Stripe functionality is fully integrated and working, PayPal integration is left as a demonstration due to difficulties in obtaining API access. Additionally, the refund functionality for both payment gateways is implemented in the backend but is not fully displayed in the frontend.
        </p>
    </div>
@endsection
