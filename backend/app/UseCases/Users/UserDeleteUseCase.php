<?php

namespace App\UseCases\Users;

use App\Http\Requests\Users\UserDeleteRequest;
use App\Models\User;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserDeleteUseCase
{
    public function __invoke(UserDeleteRequest $request, int $id): bool
    {
        $delete = $request->input('delete');
        $user = User::withTrashed()->find($id);

        if($delete) {
            if($user->trashed()) {
                throw new BadRequestHttpException('The user is already in black list.');
            }

            $user->delete();

            return true;
        }

        if(!$user->trashed()) {
            throw new BadRequestHttpException('The user is not in a black list.');
        }

        $user->restore();

        return true;
    }
}
