<?php

namespace App\Services;

use App\Contracts\PaymentGatewayInterface;
use App\Contracts\PaymentRepositoryInterface;

class PayPalPaymentService implements PaymentGatewayInterface
{
    protected $paymentRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }
    public function createPaymentIntent(string $email, float $amount, int $orderId)
    {

    }

    public function confirmPaymentStatus(string $paymentId)
    {

    }

    public function processRefund(string $paymentId, float $amount = null)
    {

    }
}
