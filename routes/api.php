<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/products', [ProductController::class, 'index']);

//Product routes
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

/* localhost:8000/api/register  || Login register routes*/
// Route::post("/register", [UserController::class, "register"]);
// Route::post("/login", [UserController::class, "login"]);

//autenticated routes //TODO megcsinalni hogy csak az admin tudjon szerkeszteni
Route::middleware("auth:sanctum")->group(function () {
    //user functions
    // Route::controller(UserController::class)->group(function () {
    //     Route::post("/logout", "logout");
    //     Route::get("/user", "user");
    // });
});

//product functions
Route::controller(ProductController::class)->group(function () {
    Route::post('/products', 'store');
    Route::put('/products/{product}', 'update');
    Route::patch('/products/{product}', 'update');
    Route::delete('/products/{product}', 'destroy');
});
