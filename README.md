# Carbonic Assessment

Carbonic Assessment is a Laravel-based application designed to showcase modern best practices for integrating third-party services, specifically payment gateways like **Stripe** and **PayPal**. The project demonstrates how to build clean, scalable, and professional code while leveraging Laravel's ecosystem, Eloquent relationships, and background job processing.

## Key Features and Objectives:

- **Stripe Integration**: Seamless payment processing using Stripe's API. Full payment flow, including payment intent creation and confirmation, is implemented and fully functional.
- **PayPal Integration**: Basic order setup for demonstration purposes only due to limitations in obtaining API keys.
- **Repository & Service Layer Patterns**: Implementation of Repository and Service Layers ensures clean, maintainable, and testable code.
- **Complex Eloquent Relationships**: Integration of `One-to-Many` and `Many-to-Many` relationships between users, orders, and products, demonstrating efficient data handling.
- **Third-Party API Integration**: External APIs (like Stripe) are integrated to process payments and retrieve statuses. Mock APIs from **Mocky** are used for syncing order and product data via background jobs.
- **Background Jobs with Laravel**: Background processes are handled via Laravel Jobs, ensuring smooth order and payment syncing with external APIs without interrupting the user experience.
- **Responsive UI**: The frontend is built using Blade templating, CSS, and AJAX to provide a dynamic and user-friendly interface.

## Technologies Used:

- **Laravel 10**: Backend framework.
- **Stripe API**: Full integration, including payment intent creation, confirmation, and error handling.
- **PayPal API**: Basic setup for demonstration purposes only, as API key access was limited.
- **Blade Templating Engine**: For rendering frontend templates.
- **JavaScript & AJAX**: For handling client-side interactions and processing payments.
- **Laravel Jobs**: For background tasks, ensuring non-blocking operations for syncing orders and products.
- **CSS**: Custom styling for a modern and responsive UI.

## Core Functionalities:

- **Order Placement and Payment**: Users can place orders by selecting products and proceeding with payments via Stripe (fully functional) or PayPal (demonstration only).
- **Background Job Processing**: Ensures smooth payment and data syncing with external APIs in the background.
- **Eloquent Relationships**: Complex `One-to-Many` and `Many-to-Many` relationships are used to manage users, orders, and products.
- **Dynamic Order & Payment Management**: Order history and payment statuses are displayed dynamically in a user-friendly format, leveraging Laravel's Eloquent ORM.

## Integration Highlights:

- **Stripe & PayPal Integration**: The application demonstrates how to integrate third-party payment APIs using the **Repository** and **Service Layer** design patterns, ensuring clean and scalable code architecture. While the Stripe integration is fully functional, PayPal is left as a demo with a basic order structure.
- **Syncing with External APIs**: The application transfers order and product data to external mock APIs (Mocky) using background jobs, ensuring seamless syncing and non-blocking operations.
- **Use of Factories**: Created mock data for users, orders, products etc via factories.

## Challenges & Limitations:

- **PayPal Integration**: PayPal is implemented as a demonstration, but full functionality is limited due to issues in obtaining API access.
- **Refund Functionality**: Refund logic has been implemented for both Stripe and PayPal in the backend, but it is not fully integrated with the frontend.
- **Country-Specific Restrictions**: The full PayPal payment flow could not be tested or completed due to API key access limitations related to country-specific restrictions.

## Steps to Test the Application:

1. **Clone the Repository**: Clone the project repository to your local environment.
2. **Install Dependencies**: Run `composer install` to install the necessary dependencies.
3. **Environment Setup**: Create a `.env` file by copying the `.env.example` file. Set up the necessary environment variables, including database, Stripe API keys, and (if applicable) PayPal API keys.
4. **Run Migrations**: Execute `php artisan migrate` to set up the database schema.
5. **Seed the Database**: Run `php artisan db:seed` to populate the database with sample data for users, products, and orders.
6. **Queue Workers**: Run `php artisan queue:work` to start processing background jobs for syncing data with external APIs.
7. **Stripe Configuration**: Ensure that your Stripe API keys are correctly set up in the `.env` file for full payment processing functionality.
8. **Testing Stripe Payments**: Navigate to the payment page, select products, and process a payment via Stripe to ensure everything works as expected.
9. **Testing PayPal Integration**: PayPal integration can be tested on the front end, but it is limited to demonstration purposes as API keys were not fully available for testing. No payment will be processed.
10. **Background Jobs**: After placing orders, check the database to verify that data has been synced with external mock APIs via Laravel Jobs.

## Usage Instructions:

### How to Make a Payment (Stripe):

1. Navigate to the orders page.
2. Select **Stripe** as the payment gateway.
3. Enter your details and proceed with the payment.
4. If successful, you will see a confirmation modal and the payment will be processed.

### How to View PayPal Integration (Demonstration Only):

1. Navigate to the orders page.
2. Select **PayPal** as the payment gateway.
3. The demonstration flow for order creation will be visible (requires API key setup for full functionality).

## Future Work:

- **Full PayPal Integration**: Pending access to PayPal API keys.
- **Refund Functionality in Frontend**: While backend support for refunds is implemented, the frontend needs to display the refund option for users.
- **Additional Payment Gateways**: Expansion to include more payment gateway options, such as Authorize.net or Square.

## License

This project is open-sourced software licensed under the [MIT License](https://opensource.org/licenses/MIT).
