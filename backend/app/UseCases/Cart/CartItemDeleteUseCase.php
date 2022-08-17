<?php

namespace App\UseCases\Cart;

use App\Http\Requests\Cart\CartItemDeleteRequest;
use Illuminate\Support\Facades\Cache;

class CartItemDeleteUseCase
{
    public function __invoke(CartItemDeleteRequest $request): bool
    {
        $cacheKey = auth()->user()->id . '_cart';
        $quantity = (int) $request->input('quantity');

        $items = Cache::get($cacheKey);

        foreach ($items as $key => $item) {
            if($item['product']['id'] === (int) $request->get('id')) {
                if($quantity) {
                    $items[$key]['quantity'] = $quantity;
                } else {
                    unset($items[$key]);
                }
            }
        }
        Cache::put($cacheKey, $items, now()->addMinutes(60));

        return true;
    }
}
