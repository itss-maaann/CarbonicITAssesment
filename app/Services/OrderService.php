<?php

namespace App\Services;

use App\Jobs\SyncOrderJob;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;

class OrderService
{
    protected OrderRepository $orderRepository;
    protected ProductRepository $productRepository;

    public function __construct(OrderRepository $orderRepository, ProductRepository $productRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
    }

    public function getUserOrders(int $userId): array
    {
        return $this->orderRepository->findByUserId($userId);
    }

    public function getAllProducts(): array
    {
        return $this->productRepository->getAll();
    }

    public function getOrderById(int $orderId): array
    {
        return $this->orderRepository->findByIdWithUser($orderId);
    }

    public function updateOrderAfterPayment(int $orderId, string $paymentId, string $status): void
    {
        $this->orderRepository->update($orderId, [
            'payment_id' => $paymentId,
            'status' => $status
        ]);
    }

    public function updateOrderStatus(int $orderId, string $status): void
    {
        $this->orderRepository->update($orderId, ['status' => $status]);
    }

    public function createOrder(array $data): array
    {
        $products = $this->productRepository->findByIds($data['products']);
        $totalAmount = array_reduce($products, function ($sum, $product) {
            return $sum + $product['price'];
        }, 0);

        $order = $this->orderRepository->create([
            'user_id' => 1,
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'payment_method' => $data['gateway']
        ]);

        $this->orderRepository->attachProducts($order['id'], $data['products']);

        $this->syncOrderWithExternalService($order, $products);

        return $order;
    }

    /**
     * Sync order data with the external service via a background job.
     *
     * @param array $order
     * @param array $products
     */
    protected function syncOrderWithExternalService(array $order, array $products): void
    {
        $orderData = [
            'order_id' => $order['id'],
            'user_id' => $order['user_id'],
            'total_amount' => $order['total_amount'],
            'products' => array_map(function ($product) {
                return [
                    'product_id' => $product['id'],
                    'name' => $product['name'],
                    'price' => $product['price'],
                ];
            }, $products)
        ];

        SyncOrderJob::dispatch($orderData);
    }
}
