<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BidController;
use App\Http\Controllers\ProfileController;
<<<<<<< HEAD
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AboutUsController;
=======
use App\Http\Controllers\DashboardController;
>>>>>>> be79229 (Admin Dashboard basic)

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/profile', [ProfileController::class, 'show'])
    ->middleware('auth')
    ->name('profile');

<<<<<<< HEAD
Route::post('/products/{product}/bids', [BidController::class, 'store'])
    ->middleware('auth')
    ->name('products.bids.store');

Route::resource('products', ProductController::class);
Route::get('/aboutus', [AboutUsController::class, 'index'])->name('aboutus');
=======
Route::resource('products', App\Http\Controllers\ProductController::class);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
>>>>>>> be79229 (Admin Dashboard basic)
