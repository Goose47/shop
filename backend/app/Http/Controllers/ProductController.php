<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\ProductStoreRequest;
use App\Http\Requests\Products\ProductUpdateRequest;
use App\Models\Product;
use App\Transformers\ProductTransformer;
use App\Transformers\SuccessTransformer;
use App\UseCases\Products\ProductDeleteUseCase;
use App\UseCases\Products\ProductStoreUseCase;
use App\UseCases\Products\ProductUpdateUseCase;
use Illuminate\Http\Request;
use Spatie\Fractal\Fractal;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Fractal
    {
        return fractal(Product::selectRaw('*, SUBSTRING(description, 1, 150) as description')->latest()->get(), new ProductTransformer());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        ProductStoreRequest $request,
        ProductStoreUseCase $case
    ): Fractal
    {
        return fractal($case($request), new ProductTransformer());
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): Fractal
    {
        return fractal($product, new ProductTransformer());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ProductUpdateRequest $request,
        Product $product,
        ProductUpdateUseCase $case
    ): Fractal
    {
        return fractal($case($request, $product), new ProductTransformer());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Product $product,
        ProductDeleteUseCase $case
    ): Fractal
    {
        return fractal($case($product), new SuccessTransformer());
    }
}
