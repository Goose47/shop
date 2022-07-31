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

//TODO: VUE
//TODO: add route and loading animations
//TODO: add catch all route
//TODO: add previous page router functionality
//TODO: refactor component names
//TODO: refactor components (check for computed use, props and data as an objects, code style)
//TODO: check vuex usage (getters, actions)
//TODO: add product edit functionality
//TODO: add dashboard
//TODO: add orders CRUD
//TODO: add filters to lists
//TODO: add list animations
//TODO: add teleport tag to modal screen
//TODO: add user filter for banned users and an ability to remove the ban
//TODO: remove register functionality, admins should create other admins
//TODO: product create: validate images via yup
//TODO: product create: fix price (backend accepts it in cents)
//TODO: add phone number input filter
//TODO: add a thumbnail for no image product
//TODO:
//TODO: ADD A CUSTOMER APP
//TODO: customer app must have a checkout, a cart
//TODO:
//TODO:
//TODO:
//TODO:
//TODO: Laravel
//TODO: add cart functionality
//TODO: add orders
//TODO: add checkout functionality (Stripe)
//TODO: add BaseFilter class and filters for users, products and so on
//TODO: add phone number requirements
//TODO: CSRF?????
//TODO:
//TODO: add refresh tokens and a "Remember me" functionality
//TODO: add token scopes for admins and customers
//TODO: prohibit to ban urself lol
//TODO:
//TODO: DEPLOY
//TODO: add nginx to docker
//TODO: add frontend images to docker ?????
//TODO: configure a server
//TODO: add ssl certificate (certbot)
//TODO:
//TODO:
//TODO:
