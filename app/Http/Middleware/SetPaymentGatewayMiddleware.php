<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\StripePaymentService;
use App\Services\PayPalPaymentService;
use App\Contracts\PaymentGatewayInterface;

class SetPaymentGatewayMiddleware
{
    public function handle($request, Closure $next)
    {
        $gateway = $request->input('gateway', 'stripe');

        $request->attributes->set('gateway', $gateway);

        return $next($request);
    }
}
