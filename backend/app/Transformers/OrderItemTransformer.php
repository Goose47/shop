<?php

namespace App\Transformers;

use App\Models\OrderItem;
use League\Fractal\TransformerAbstract;

class OrderItemTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        'product'
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(OrderItem $orderItem)
    {
        return [
            'quantity' => $orderItem->quantity
        ];
    }

    public function includeProduct(OrderItem $orderItem)
    {
        return $this->item($orderItem->product, new ProductTransformer());
    }

}
