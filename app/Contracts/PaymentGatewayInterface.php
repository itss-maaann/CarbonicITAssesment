<?php

namespace App\Contracts;

interface PaymentGatewayInterface
{
    public function createPaymentIntent(string $email, float $amount, int $orderId);
    public function confirmPaymentStatus(string $paymentId);
    public function processRefund(string $paymentId, float $amount = null);
}
