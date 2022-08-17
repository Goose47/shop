<?php

namespace App\UseCases\Order;

use App\Http\Requests\Orders\OrderStoreRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\StripeService;

class OrderStoreUseCase
{
    /**
     * @var StripeService
     */
    private StripeService $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    public function __invoke(OrderStoreRequest $request)
    {
        $order = Order::create([
           'status' => 'pending',
           'user_id' => auth()->user()->id
        ]);

        foreach ($request->input('order_items') as $orderItem) {
            $order->items()->create($orderItem);
        }

        $order->save();

        return $this->stripeService->getCheckoutUrl(OrderItem::where('order_id', $order->id)->with('product')->get());
    }
}
