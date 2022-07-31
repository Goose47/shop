<?php

namespace App\Transformers;

use App\Models\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        'images'
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price / 100,
            'created_at' => isset($product->created_at) ? $product->created_at->toDateTimeString() : null,
            'updated_at' => isset($product->updated_at) ? $product->updated_at->toDateTimeString() : null,
        ];
    }

    public function includeImages(Product $product)
    {
        return $this->collection($product->images, new ImageTransformer());
    }
}
