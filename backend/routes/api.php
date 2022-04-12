<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
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
});

Route::middleware('auth')->group(function() {
   Route::post('/logout', [AuthController::class, 'logout']);

   Route::apiResource('/users', UserController::class);
   Route::post('/users/{id}/delete', [UserController::class, 'delete']);

   Route::apiResource('/products', ProductController::class);
});

Route::middleware('auth')->get('/test', function() {
    return auth()->user()->name;
});
