<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
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
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'full_name' => $user->full_name,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'created_at' => isset($user->created_at) ? $user->created_at->toDateTimeString() : null,
            'updated_at' => isset($user->updated_at) ? $user->updated_at->toDateTimeString() : null,
            'deleted_at' => isset($user->deleted_at) ? $user->deleted_at->toDateTimeString() : null,
        ];
    }
}
