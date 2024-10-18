<?php

namespace App\Repositories;

use App\Contracts\PaymentRepositoryInterface;
use App\Models\StripeTransaction;

class StripePaymentRepository implements PaymentRepositoryInterface
{
    protected $stripeTransaction;

    public function __construct(StripeTransaction $stripeTransaction)
    {
        $this->stripeTransaction = $stripeTransaction;
    }

    public function create(array $data)
    {
        return $this->stripeTransaction->create($data);
    }

    public function findByPaymentId(string $paymentId)
    {
        return $this->stripeTransaction->where('stripe_payment_id', $paymentId)->first();
    }

    public function updateStatus(string $paymentId, string $status)
    {
        return $this->stripeTransaction->where('stripe_payment_id', $paymentId)->update(['status' => $status]);
    }
}
