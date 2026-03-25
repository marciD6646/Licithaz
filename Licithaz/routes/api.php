<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\BidController;
use App\Http\Controllers\Api\UserController;

// Admin auth (public)
Route::post('/admin/login', [AdminAuthController::class, 'login']);

// PUBLIC ROUTES
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);
//BID
Route::get('/bids', [BidController::class, 'index']);
Route::get('/users', [UserController::class, 'index']); 



// AUTHENTICATED ROUTES (admin-only, enforced in controllers/requests)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin/me', [AdminAuthController::class, 'me']);
    Route::post('/admin/logout', [AdminAuthController::class, 'logout']);


    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::patch('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);
});