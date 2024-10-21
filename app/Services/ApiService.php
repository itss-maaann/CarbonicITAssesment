<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiService
{
    protected $orderApiUrl;
    protected $productApiUrl;

    public function __construct()
    {
        $this->orderApiUrl = config('services.external_api.order_url');
        $this->productApiUrl = config('services.external_api.product_url');
    }

    public function syncOrder(array $orderData)
    {
        try {
            $response = Http::post($this->orderApiUrl, $orderData);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Failed to sync order', ['error' => $response->body()]);
            return false;
        } catch (\Exception $e) {
            Log::error('Error syncing order', ['error' => $e->getMessage()]);
            return false;
        }
    }

    public function syncProduct(array $productData)
    {
        try {
            $response = Http::post($this->productApiUrl, $productData);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Failed to sync product', ['error' => $response->body()]);
            return false;
        } catch (\Exception $e) {
            Log::error('Error syncing product', ['error' => $e->getMessage()]);
            return false;
        }
    }
}
