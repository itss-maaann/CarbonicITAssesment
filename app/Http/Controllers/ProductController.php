<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(): \Illuminate\View\View
    {
        $products = $this->productService->getAllProducts();
        return view('products', compact('products'));
    }

    public function store(CreateProductRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->productService->createProduct($request->validated());
        return redirect()->route('products.index')->with('success', 'Product added successfully and syncing in the background.');
    }
}
