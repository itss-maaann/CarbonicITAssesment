<?php

namespace App\Factories;

use App\Contracts\PaymentGatewayInterface;
use App\Services\StripePaymentService;
use App\Services\PayPalPaymentService;

class PaymentGatewayFactory
{
    public static function make(string $gateway): PaymentGatewayInterface
    {
        switch ($gateway) {
            case 'paypal':
                return app(PayPalPaymentService::class);
            case 'stripe':
            default:
                return app(StripePaymentService::class);
        }
    }
}
