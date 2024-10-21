<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    public function findByUserId(int $userId): array
    {
        return Order::with('products')->where('user_id', $userId)->get()->toArray();
    }

    public function create(array $data): array
    {
        return Order::create($data)->toArray();
    }

    public function attachProducts(int $orderId, array $productIds): void
    {
        $order = Order::find($orderId);
        $order->products()->attach($productIds);
    }

    public function findByIdWithUser(int $orderId): array
    {
        return Order::with('user')->find($orderId)->toArray();
    }

    public function update(int $orderId, array $data): bool
    {
        $order = Order::find($orderId);
        return $order->update($data);
    }
}
