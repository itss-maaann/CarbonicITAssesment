<?php

namespace App\Jobs;

use App\Models\Product;
use App\Services\ApiService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $product;

    public function __construct(array $product)
    {
        $this->product = $product;
    }

    public function handle(ApiService $apiService): void
    {
        $apiService->syncProduct($this->product);
    }
}
