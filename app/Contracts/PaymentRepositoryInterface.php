<?php

namespace App\Contracts;

interface PaymentRepositoryInterface
{
    public function create(array $data);
    public function findByPaymentId(string $paymentId);
    public function updateStatus(string $paymentId, string $status);
}
