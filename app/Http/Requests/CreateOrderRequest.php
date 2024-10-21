<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
            'gateway' => 'required|in:' . implode(',', array_keys(config('paymentGateways'))),
        ];
    }
}
