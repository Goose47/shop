<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class UrlTransformer extends TransformerAbstract
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
    public function transform(string $url)
    {
        return [
            'url' => $url
        ];
    }
}
