<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function findByIds(array $productIds): array
    {
        return Product::whereIn('id', $productIds)->get()->toArray();
    }

    public function getAll(): array
    {
        return Product::all()->toArray();
    }

    public function create(array $data): array
    {
        return Product::create($data)->toArray();
    }
}
