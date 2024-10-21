<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(): \Illuminate\View\View
    {
        $orders = $this->orderService->getUserOrders(1);
        $products = $this->orderService->getAllProducts();
        return view('order', compact('products', 'orders'));
    }

    public function store(CreateOrderRequest $request): \Illuminate\Http\RedirectResponse
    {
        $order = $this->orderService->createOrder($request->validated());

        return redirect()->route('payment.form', [
            'order' => $order['id'],
            'gateway' => $request->gateway
        ]);
    }
}

