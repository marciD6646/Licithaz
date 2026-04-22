<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\BidController;
use App\Http\Controllers\Api\UserController;
use App\Models\Product;
use App\Models\User;

// Admin auth (public)
Route::post('/admin/login', [AdminAuthController::class, 'login']);

// PUBLIC ROUTES
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);
//BID
Route::get('/bids', [BidController::class, 'index']);



// AUTHENTICATED ROUTES (admin-only, enforced in controllers/requests)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin/me', [AdminAuthController::class, 'me']);
    Route::post('/admin/logout', [AdminAuthController::class, 'logout']);

    Route::get('/admin/users', [UserController::class, 'index'])
        ->middleware('can:viewAny,' . User::class);
    Route::post('/admin/users/ban/{user}', [UserController::class, 'banUser'])
        ->middleware('can:ban,user');
    Route::post('/admin/users/unban/{user}', [UserController::class, 'unbanUser'])
        ->middleware('can:unban,user');

    Route::get('/admin/users/{user}/bids', [BidController::class, 'userBids'])
        ->middleware('auth:sanctum');


    Route::post('/products', [ProductController::class, 'store'])
        ->middleware('can:create,' . Product::class);
    Route::put('/products/{product}', [ProductController::class, 'update'])
        ->middleware('can:update,product');
    Route::patch('/products/{product}', [ProductController::class, 'update'])
        ->middleware('can:update,product');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->middleware('can:delete,product');
});