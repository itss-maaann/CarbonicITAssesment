<?php

namespace App\Services;

use App\Contracts\PaymentGatewayInterface;
use App\Contracts\PaymentRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Stripe\PaymentIntent;
use Stripe\Refund;
use Stripe\Stripe;

class StripePaymentService implements PaymentGatewayInterface
{
    protected $paymentRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function createPaymentIntent(string $email, float $amount)
    {
        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $amount * 100, // Amount in cents
                'currency' => 'usd',
                'receipt_email' => $email,
                'payment_method_types' => ['card'],
            ]);

            $this->paymentRepository->create([
                'stripe_payment_id' => $paymentIntent->id,
                'email' => $email,
                'amount' => $amount,
                'status' => 'pending',
            ]);

            return $paymentIntent;
        } catch (\Exception $e) {
            Log::error('Stripe Payment Creation Failed', ['error' => $e->getMessage()]);
            return null;
        }
    }

    public function confirmPaymentStatus(string $paymentId)
    {
        try {
            $paymentIntent = PaymentIntent::retrieve($paymentId);
            $status = $paymentIntent->status === 'succeeded' ? 'succeeded' : 'failed';

            $this->paymentRepository->updateStatus($paymentId, $status);
            return $status;
        } catch (\Exception $e) {
            Log::error('Stripe Payment Confirmation Failed', ['error' => $e->getMessage()]);
            return null;
        }
    }

    public function processRefund(string $paymentId, float $amount = null)
    {
        try {
            $refundData = ['payment_intent' => $paymentId];

            if ($amount) {
                $refundData['amount'] = $amount * 100;
            }

            $refund = Refund::create($refundData);

            if ($refund->status === 'succeeded') {
                $this->paymentRepository->updateStatus($paymentId, 'refunded');
                return $refund;
            }

            return null;
        } catch (\Exception $e) {
            Log::error('Stripe Refund Failed', ['error' => $e->getMessage()]);
            return null;
        }
    }
}
