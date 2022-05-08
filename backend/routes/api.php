<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('guest')->group(function() {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/password-forgot', [PasswordResetController::class, 'sendResetLink']);
    Route::post('/password-reset', [PasswordResetController::class, 'resetPassword']);
});

Route::middleware('auth')->group(function() {
   Route::get('/user', [AuthController::class, 'user']);
   Route::post('/logout', [AuthController::class, 'logout']);

   Route::apiResource('/users', UserController::class);
   Route::post('/users/{id}/delete', [UserController::class, 'delete']);

   Route::apiResource('/products', ProductController::class);
});

Route::middleware('auth')->get('/test', function() {
    return auth()->user()->name;
});
