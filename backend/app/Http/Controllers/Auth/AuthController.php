<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Transformers\AccessTokenTransformer;
use App\Transformers\SuccessTransformer;
use App\Transformers\UserTransformer;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use function auth;
use function fractal;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        if($user) {
            if(Hash::check($request->input('password'), $user->password)) {
                $token = $user->createToken('jwt')->accessToken;

                $cookie = \cookie('jwt', $token, 3600);
            } else {
                throw new BadRequestHttpException('Password mismatch');
            }
        } else {
            throw new BadRequestHttpException('There is no such user');
        }

//        return fractal($token, new AccessTokenTransformer());
        return \response([
            'token' => $token
        ])->withCookie($cookie);
    }

    public function logout()
    {
        auth()->user()->token()->revoke();

        return fractal(true, new SuccessTransformer());
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->only('name', 'email', 'first_name', 'last_name', 'phone_number') + [
                'password' => Hash::make($request->input('password'))
            ]);

        return fractal($user, new UserTransformer());
    }

    public function user()
    {
        return fractal(auth()->user(), new UserTransformer());
    }
}
