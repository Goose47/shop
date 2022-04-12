<?php

namespace App\UseCases\Users;

use App\Http\Requests\Users\UserUpdateRequest;
use App\Models\User;

class UserUpdateUseCase
{
    public function __invoke(UserUpdateRequest $request, User $user): User
    {
        $user->update($request->validated());

        return $user;
    }
}
