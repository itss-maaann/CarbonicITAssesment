<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Jobs\SyncProductJob;

class ProductService
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts(): array
    {
        return $this->productRepository->getAll();
    }

    public function createProduct(array $data): array
    {
        $product = $this->productRepository->create($data);

        SyncProductJob::dispatch($product);

        return $product;
    }
}
