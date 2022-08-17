<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\CartItemDeleteRequest;
use App\Http\Requests\Cart\CartItemStoreRequest;
use App\Transformers\CartItemTransformer;
use App\Transformers\SuccessTransformer;
use App\UseCases\Cart\CartItemDeleteUseCase;
use App\UseCases\Cart\CartItemStoreUseCase;
use Illuminate\Support\Facades\Cache;

class CartController extends Controller
{
    public function index()
    {
        return fractal(Cache::get(auth()->user()->id . '_cart'), new CartItemTransformer());
    }

    public function store(
        CartItemStoreRequest $request,
        CartItemStoreUseCase $case
    )
    {
        return fractal($case($request), new SuccessTransformer());
    }

    public function destroy(
        CartItemDeleteRequest $request,
        CartItemDeleteUseCase $case
    )
    {
        return fractal($case($request), new SuccessTransformer());
    }
}
