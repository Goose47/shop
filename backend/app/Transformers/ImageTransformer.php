<?php

namespace App\Transformers;

use App\Models\Image;
use League\Fractal\TransformerAbstract;

class ImageTransformer extends TransformerAbstract
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
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Image $image)
    {
        return [
            'path' => $image->path,
            'created_at' => isset($image->created_at) ? $image->created_at->toDateTimeString() : null,
            'udpated_at' => isset($image->udpated_at) ? $image->udpated_at->toDateTimeString() : null,
        ];
    }
}
