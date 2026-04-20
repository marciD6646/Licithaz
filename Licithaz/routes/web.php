<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BidController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Models\Bid;
use App\Models\Product;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
    ->name('profile.password.update');
Route::patch('/profile', [ProfileController::class, 'update'])
    ->name('profile.update');

Route::get('/profile', [ProfileController::class, 'show'])
    ->middleware('auth')
    ->name('profile');

Route::post('/products/{product}/bids', [BidController::class, 'store'])
    ->middleware(['auth', 'can:create,' . Bid::class])
    ->name('products.bids.store');

Route::resource('products', ProductController::class)
    ->only(['index', 'show'])
    ->whereNumber('product');

Route::middleware('auth')->group(function () {

    Route::get('/products/create', [ProductController::class, 'create'])
        ->middleware('can:create,' . Product::class)
        ->name('products.create');

    Route::post('/products', [ProductController::class, 'store'])
        ->middleware('can:create,' . Product::class)
        ->name('products.store');

    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
        ->middleware('can:update,product')
        ->name('products.edit');

    Route::match(['put', 'patch'], '/products/{product}', [ProductController::class, 'update'])
        ->middleware('can:update,product')
        ->name('products.update');

    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->middleware('can:delete,product')
        ->name('products.destroy');

    Route::post('/products/{id}/restore', [ProductController::class, 'restore'])
        ->name('products.restore');

    Route::delete('/products/{id}/force-delete', [ProductController::class, 'forceDelete'])
        ->name('products.forceDelete');
});

Route::get('/aboutus', [AboutUsController::class, 'index'])->name('aboutus');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'can:viewAny,' . User::class])
    ->name('dashboard');

Route::post('/users/{user}/toggle-ban', [UserController::class, 'toggleBan'])
    ->middleware(['auth', 'can:ban,user'])
    ->name('users.toggleBan');

Route::middleware('auth')->group(function () {

    Route::get('/users/{user}/edit', [UserController::class, 'edit'])
        ->name('users.edit');

    Route::put('/users/{user}', [UserController::class, 'update'])
        ->name('users.update');
});

Route::get('/payment', function () {
    return view('payment');
});