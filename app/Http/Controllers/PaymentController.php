<?php

namespace App\Http\Controllers;

use App\Contracts\PaymentGatewayInterface;
use App\Http\Requests\CreatePaymentRequest;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    protected PaymentGatewayInterface $paymentService;
    protected OrderService $orderService;

    public function __construct(PaymentGatewayInterface $paymentService, OrderService $orderService)
    {
        $this->paymentService = $paymentService;
        $this->orderService = $orderService;
    }

    public function showPaymentForm(int $orderId, string $gateway): \Illuminate\View\View
    {
        $order = $this->orderService->getOrderById($orderId);

        return view("payment.{$gateway}", ['order' => $order]);
    }

    public function createPayment(CreatePaymentRequest $request): \Illuminate\Http\JsonResponse
    {
        DB::beginTransaction();
        try {
            $paymentIntent = $this->paymentService->createPaymentIntent(
                $request->email,
                $request->amount,
                $request->order_id
            );

            if ($paymentIntent) {
                $this->orderService->updateOrderAfterPayment(
                    $request->order_id,
                    $paymentIntent->id,
                    'processing'
                );
                DB::commit();
                return response()->json(['clientSecret' => $paymentIntent->client_secret], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Payment creation failed'], 500);
        }
    }

    public function confirmPayment(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'paymentId' => 'required',
            'order_id' => 'required|exists:orders,id',
        ]);

        try {
            $status = $this->paymentService->confirmPaymentStatus($request->paymentId);

            if ($status === 'succeeded') {
                $this->orderService->updateOrderStatus($request->order_id, 'completed');
                return response()->json(['status' => 'succeeded'], 200);
            }
            return response()->json(['error' => 'Payment confirmation failed'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Payment confirmation error'], 500);
        }
    }

    public function processRefund(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'payment_id' => 'required|string',
            'amount' => 'nullable|numeric|min:1',
        ]);

        try {
            $refund = $this->paymentService->processRefund(
                $validated['payment_id'],
                $validated['amount'] ?? null
            );

            if ($refund) {
                return response()->json(['refund' => 'Refund succeeded!'], 200);
            }
            return response()->json(['error' => 'Refund failed'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Refund process error'], 500);
        }
    }
}
