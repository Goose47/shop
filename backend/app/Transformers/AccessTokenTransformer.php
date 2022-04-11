<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class AccessTokenTransformer extends TransformerAbstract
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
    public function transform(string $token)
    {
        return [
            'access_token' => $token
        ];
    }
}
