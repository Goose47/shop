<?php

namespace App\Http\Controllers\Admin;

use App\Filters\UserFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserDeleteRequest;
use App\Http\Requests\Users\UserStoreRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Models\User;
use App\Transformers\SuccessTransformer;
use App\Transformers\UserTransformer;
use App\UseCases\Users\UserDeleteUseCase;
use App\UseCases\Users\UserStoreUseCase;
use App\UseCases\Users\UserUpdateUseCase;
use Illuminate\Http\Request;
use Spatie\Fractal\Fractal;

class UserController extends Controller
{
    public function index(Request $request, UserFilter $filter): Fractal
    {
        return fractal(User::withTrashed()->filter($filter)->latest()->paginate($request->input('per_page', 2)), new UserTransformer());
    }

    public function show($id): Fractal
    {
        $user = User::withTrashed()->find($id);

        return fractal($user, new UserTransformer());
    }

    public function store(
        UserStoreRequest $request,
        UserStoreUseCase $case
    ): Fractal
    {
        return fractal($case($request), new UserTransformer());
    }

    public function update(
        UserUpdateRequest $request,
        User $user,
        UserUpdateUseCase $case
    ): Fractal
    {
        return fractal($case($request, $user), new UserTransformer());
    }

    public function destroy($id): Fractal
    {
        User::withTrashed()->find($id)->forceDelete();

        return fractal(true, new SuccessTransformer());
    }

    public function delete(
        UserDeleteRequest $request,
        int $id,
        UserDeleteUseCase $case
    ): Fractal
    {
        return fractal($case($request, $id), new SuccessTransformer());
    }
}
