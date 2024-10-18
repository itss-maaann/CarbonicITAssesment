<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Carbonic Assessment

Carbonic Assessment is a Laravel-based application designed to showcase secure payment integration using both **Stripe** and **PayPal** payment gateways. The application is built with a clean and professional UI to demonstrate seamless payment processing, refund functionalities, and integration best practices.

### Features:
- **Stripe Integration**: Secure payments with 3D Secure support.
- **PayPal Integration**: PayPal payments with simple order creation and capture flows (demonstration only).
- **Professional UI**: Clean, responsive, and user-friendly interface.
- **Payment Refund Demonstration**: Although not fully integrated with the UI, refund logic is implemented for demonstration purposes.
- **Error Handling**: User-friendly error handling with modal dialogs.

### Notes:
- **PayPal Integration**: Due to account creation limitations and API key access issues (unable to create PayPal account due to country restrictions), the PayPal functionality is provided as a basic demonstration. The necessary functions are implemented but not fully tested or finalized.
- **Stripe Payment Processing**: The Stripe payment gateway is fully implemented, including payment intent creation, confirmation, and error handling.

## How to Use:

1. **Stripe Payment**:
    - Navigate to the payment page.
    - Select Stripe, fill in your email, amount, and card details.
    - Click "Pay Now" to process the payment.

2. **PayPal Payment** (Demonstration):
    - Navigate to the payment page.
    - Select PayPal and proceed with the simulated order (requires API key setup for full functionality).

## Technologies Used:
- **Laravel 10** (Backend framework)
- **Stripe API** (Payment Gateway)
- **PayPal API** (Demonstration only)
- **Blade Templating Engine** (Frontend)
- **JavaScript** (AJAX for payment processing)

## Disclaimer:
- This is a test application designed for demonstration purposes only.
- PayPal integration is currently in a demonstration phase and not fully functional due to the lack of access to API keys.
- Refund logic is implemented but not displayed on the frontend.

## Contributing

Thank you for considering contributing to the Carbonic Assessment application! Feel free to submit pull requests or report issues in the repository.

## License

The Carbonic Assessment project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
