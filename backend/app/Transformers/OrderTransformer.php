<?php

namespace App\Transformers;

use App\Models\Order;
use League\Fractal\TransformerAbstract;

class OrderTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        'orderItems'
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        'orderItems'
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Order $order)
    {
        return [
            'id' => $order->id,
            'user_id' => $order->user_id,
            'status' => $order->status,
            'created_at' => isset($product->created_at) ? $product->created_at->toDateTimeString() : null,
            'updated_at' => isset($product->updated_at) ? $product->updated_at->toDateTimeString() : null,
        ];
    }

    public function includeOrderItems(Order $order)
    {
        return $this->collection($order->items, new OrderItemTransformer(), 'false');
    }
}
