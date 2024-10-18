<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Contracts\PaymentRepositoryInterface::class,
            function ($app) {
                if (request()->input('gateway') === 'paypal') {
                    return $app->make(\App\Repositories\PayPalTransactionRepository::class);
                }
                return $app->make(\App\Repositories\StripePaymentRepository::class);
            }
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
