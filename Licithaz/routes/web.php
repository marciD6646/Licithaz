<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BidController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ResolveAuctions;
use App\Models\Bid;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/
Route::get('/profile', [ProfileController::class, 'show'])
    ->middleware('auth')
    ->name('profile');

Route::patch('/profile', [ProfileController::class, 'update'])
    ->middleware('auth')
    ->name('profile.update');

Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
    ->middleware('auth')
    ->name('profile.password.update');

/*
|--------------------------------------------------------------------------
| Products (public)
|--------------------------------------------------------------------------
*/
Route::resource('products', ProductController::class)
    ->only(['index', 'show'])
    ->whereNumber('product');

Route::get('/products/search', [ProductController::class, 'search'])
    ->name('products.search');

/*
|--------------------------------------------------------------------------
| Bids
|--------------------------------------------------------------------------
*/
Route::post('/products/{product}/bids', [BidController::class, 'store'])
    ->middleware(['auth', 'can:create,' . Bid::class])
    ->name('products.bids.store');

/*
|--------------------------------------------------------------------------
| Authenticated product management
|--------------------------------------------------------------------------
*/
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

    /*
    | Payment routes
    */
    Route::get('/products/{product}/checkout', [PaymentController::class, 'checkout'])
        ->name('products.checkout');

    Route::post('/products/{product}/pay', [PaymentController::class, 'pay'])
        ->name('products.pay');

    /*
    | My payments
    */
    Route::get('/payments', [PaymentController::class, 'index'])
        ->name('payments.index');
});

/*
|--------------------------------------------------------------------------
| About / Dashboard / Admin
|--------------------------------------------------------------------------
*/
Route::get('/aboutus', [AboutUsController::class, 'index'])
    ->name('aboutus');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'can:viewAny,' . User::class])
    ->name('dashboard');

Route::get('/admin/payments', [PaymentController::class, 'adminIndex'])
    ->middleware(['auth', 'can:viewAny,' . Payment::class])
    ->name('payments.admin');

Route::post('/users/{user}/toggle-ban', [UserController::class, 'toggleBan'])
    ->middleware(['auth', 'can:ban,user'])
    ->name('users.toggleBan');

Route::post('/admin/auctions/resolve', [ResolveAuctions::class, 'handle'])
    ->middleware(['auth', 'can:viewAny,' . User::class])
    ->name('auctions.resolve');

Route::middleware('auth')->group(function () {

    Route::get('/users/{user}/edit', [UserController::class, 'edit'])
        ->middleware('can:update,user')
        ->name('users.edit');

    Route::put('/users/{user}', [UserController::class, 'update'])
        ->middleware('can:update,user')
        ->name('users.update');
});