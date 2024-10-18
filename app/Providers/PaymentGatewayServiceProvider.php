<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\PaymentGatewayInterface;
use App\Services\StripePaymentService;
use App\Services\PayPalPaymentService;
use Illuminate\Http\Request;

class PaymentGatewayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * The register method is used to bind services in the service container.
     * We'll bind the PaymentGatewayInterface to the correct service (Stripe or PayPal) based on the request context.
     */
    public function register()
    {
        $this->app->bind(PaymentGatewayInterface::class, function ($app) {
            $request = $app->make(Request::class);

            $gateway = $request->attributes->get('gateway', 'stripe');

            return $this->resolvePaymentGateway($gateway, $app);
        });
    }

    /**
     * Boot services.
     *
     * The boot method is for post-registration of services.
     */
    public function boot()
    {

    }

    /**
     * Resolve the correct Payment Gateway Service based on the gateway name.
     *
     * @param string $gateway
     * @param \Illuminate\Contracts\Foundation\Application $app
     * @return PaymentGatewayInterface
     */
    protected function resolvePaymentGateway(string $gateway, $app): PaymentGatewayInterface
    {
        switch ($gateway) {
            case 'paypal':
                return $app->make(PayPalPaymentService::class);
            case 'stripe':
            default:
                return $app->make(StripePaymentService::class);
        }
    }
}
