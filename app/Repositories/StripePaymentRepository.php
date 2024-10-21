<?php

namespace App\Repositories;

use App\Contracts\PaymentRepositoryInterface;
use App\Models\StripeTransaction;

class StripePaymentRepository implements PaymentRepositoryInterface
{
    protected $model;

    public function __construct(StripeTransaction $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function findByPaymentId(string $paymentId)
    {
        return $this->model->where('stripe_payment_id', $paymentId)->first();
    }

    public function updateStatus(string $paymentId, string $status)
    {
        return $this->model->where('stripe_payment_id', $paymentId)->update(['status' => $status]);
    }
}
