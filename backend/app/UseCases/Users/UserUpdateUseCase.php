<?php

namespace App\UseCases\Users;

use App\Http\Requests\Users\UserUpdateRequest;
use App\Models\User;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserUpdateUseCase
{
    public function __invoke(UserUpdateRequest $request, User $user): User
    {
        if(User::where('email', $request->input('email'))->where('id', '!=', $user->id)->get()->count() > 0) {
            throw new BadRequestHttpException("the email has already been taken");
        }
        $user->update($request->validated());

        return $user;
    }
}
