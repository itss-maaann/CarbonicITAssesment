<?php

namespace App\Contracts;

interface PaymentGatewayInterface
{
    public function createPaymentIntent(string $email, float $amount);
    public function confirmPaymentStatus(string $paymentId);
    public function processRefund(string $paymentId, float $amount = null);
}
