<?php

namespace App\UseCases\Cart;

use App\Http\Requests\Cart\CartItemStoreRequest;
use App\Models\Product;
use App\Transformers\ProductTransformer;
use Illuminate\Support\Facades\Cache;

class CartItemStoreUseCase
{
    /**
     * @var ProductTransformer
     */
    private ProductTransformer $transformer;

    public function __construct(ProductTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function __invoke(CartItemStoreRequest $request): bool
    {
        $cacheKey = auth()->user()->id . '_cart';

        $items = Cache::get($cacheKey) ?? [];

        $productIsInCart = false;

        foreach ($items as $key => $item) {
            if($item['product']['id'] == $request->input('id')) {
                $productIsInCart = true;
                $productIndex = $key;
            }
        }

        if ($productIsInCart) {
            $items[$productIndex]['quantity'] += $request->input('quantity');
        } else {
            $product = $this->transformer->transform(Product::find($request->input('id')));

            $items[] = [
                'product' => $product,
                'quantity' => (int) $request->input('quantity')
            ];
        }

        Cache::put($cacheKey, $items, now()->addMinutes(60));

        return true;
    }
}
