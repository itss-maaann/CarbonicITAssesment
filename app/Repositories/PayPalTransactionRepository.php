<?php

namespace App\Repositories;

use App\Contracts\PaymentRepositoryInterface;
use App\Models\PayPalTransaction;

class PayPalTransactionRepository implements PaymentRepositoryInterface
{
    protected $payPalTransaction;

    public function __construct(PayPalTransaction $payPalTransaction)
    {
        $this->payPalTransaction = $payPalTransaction;
    }

    public function create(array $data)
    {
        return $this->payPalTransaction->create($data);
    }

    public function findByPaymentId(string $paymentId)
    {
        return $this->payPalTransaction->where('paypal_payment_id', $paymentId)->first();
    }

    public function updateStatus(string $paymentId, string $status)
    {
        return $this->payPalTransaction->where('paypal_payment_id', $paymentId)->update(['status' => $status]);
    }
}
