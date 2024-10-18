<?php

namespace App\Http\Controllers;

use App\Contracts\PaymentGatewayInterface;
use App\Http\Requests\CreatePaymentRequest;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentGatewayInterface $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function createPayment(CreatePaymentRequest $request)
    {
        $paymentIntent = $this->paymentService->createPaymentIntent(
            $request->email,
            $request->amount
        );

        if ($paymentIntent) {
            return response()->json(['clientSecret' => $paymentIntent->client_secret], 200);
        }

        return response()->json(['error' => 'Payment creation failed'], 500);
    }

    public function confirmPayment($paymentId)
    {
        $status = $this->paymentService->confirmPaymentStatus($paymentId);

        if ($status) {
            return response()->json(['status' => $status], 200);
        }

        return response()->json(['error' => 'Payment confirmation failed'], 500);
    }

    public function processRefund(Request $request)
    {
        $validated = $request->validate([
            'payment_id' => 'required|string',
            'amount' => 'nullable|numeric|min:1'
        ]);

        $refund = $this->paymentService->processRefund(
            $validated['payment_id'],
            $validated['amount'] ?? null
        );

        if ($refund) {
            return response()->json(['refund' => 'Refund succeeded!'], 200);
        }

        return response()->json(['error' => 'Refund failed'], 500);
    }
}
