<?php

namespace App\UseCases\Users;

use App\Http\Requests\Users\UserStoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserStoreUseCase
{
    public function __invoke(UserStoreRequest $request): User
    {
        $user = User::create($request->only(['first_name', 'last_name', 'phone_number', 'email']) + [
                'password' => Hash::make($request->input('password'))
            ]);

        return $user;
    }
}
