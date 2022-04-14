<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\SendResetLinkRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\PasswordResetLink;
use App\Models\User;
use App\Transformers\SuccessTransformer;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use PHPUnit\Exception;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PasswordResetController extends Controller
{
    public function sendResetLink(SendResetLinkRequest $request)
    {
        $email = $request->input('email');

        $token = strtoupper(Str::random(6));

        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token
        ]);

        Mail::to($email)->queue(new PasswordResetLink($token));

        return fractal(true , new SuccessTransformer());
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        try{
            $token = DB::table('password_resets')->where('email', $user->email)->first()->token;
        } catch (\Exception $exception) {
            throw new BadRequestHttpException('The reset link has expired.');
        }

        if($token !== $request->input('token')) {
            throw new BadRequestHttpException('Token mismatch');
        }

        $user->update([
            'password' => Hash::make($request->input('password'))
        ]);

        DB::table('password_resets')->where('email', $user->email)->delete();

        return fractal(true, new SuccessTransformer());
    }
}
