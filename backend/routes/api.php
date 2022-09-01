<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
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

   Route::get('/cart', [CartController::class, 'index']);
   Route::post('/cart', [CartController::class, 'store']);
   Route::delete('/cart', [CartController::class, 'destroy']);

   Route::apiResource('/orders', OrderController::class)->except('destroy');
});

//Stripe webhook endpoint
Route::post('/orders/proceed', [OrderController::class, 'proceedPayment'])->name('payment.proceed');

//TODO: VUE
//TODO: refactor components (check for computed use, props and data as an objects, code style)
//TODO: check vuex usage (getters, actions)

//TODO: add dashboard
//TODO: add orders CRUD
//TODO: add filters to lists
//TODO: add list animations
//TODO: add teleport tag to modal screen
//TODO: add user filter for banned users and an ability to remove the ban
//TODO: remove register functionality, admins should create other admins
//TODO: add carousel for products
//TODO: add pagination for entities
//TODO: filter animations and layout
//TODO: filter timeout, too many requests
//TODO:
//TODO: ADD A CUSTOMER APP
//TODO: customer app must have a checkout, a cart
//TODO: route change animations are faster than in admin app
//TODO:
//TODO:
//TODO:
//TODO: Laravel
//TODO: add checkout functionality (Stripe)
//TODO: add webhook for payment processing (after deployment cause webhook must e publicly accessible)
//TODO: add phone number requirements
//TODO: CSRF?????
//TODO: filter wrong column exception
//TODO: unused model properties in user list (possibly product list), check transformers
//TODO:
//TODO: add refresh tokens and a "Remember me" functionality
//TODO: add token scopes for admins and customers
//TODO: prohibit to ban urself lol
//TODO:
//TODO: DEPLOY
//TODO: add frontend images to docker ?????
//TODO: add ssl certificate (certbot)
//TODO: npm install and composer install in dockerfiles
//TODO:
//TODO: OPTIMISATION
//TODO:
//TODO: Too much queries when using includes in transformers
//TODO: memo, lazy component includes vue?
//TODO:
