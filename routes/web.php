<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ReviewController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->middleware('guest')->name('welcome');

Route::middleware(['auth', 'admin'])->group(function () {

    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //dashboard
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    //restaurant
    Route::resource('/restaurants', RestaurantController::class)->except('show');

    //tag
    Route::resource('tags', TagController::class);

    //category
    Route::resource('restaurants.categories', CategoryController::class);
    Route::post('/category', [CategoryController::class, 'store'])->name('categories.store');
    Route::patch('/category/{category}', [CategoryController::class, 'update'])->name('categories.update');

    //item
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    Route::patch('/items/{item}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    // reviews
    Route::get('/reviews', [ReviewController::class, 'manage'])->name('reviews.manage');
});

    //restaurants.show
    Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show'])->name('restaurants.show');

    //restaurants.categories.show
    Route::get('/restaurants/{restaurant}/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

    //show-my-order
    Route::get('/restaurants/{restaurant}/show-my-order', [OrderController::class, 'showMyOrder'])->name('restaurants.showMyOrder');

    //review resource
    Route::resource('restaurants.orders.reviews', ReviewController::class);

    //checkout
    Route::post('/restaurants/{restaurant}/checkout', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}/invoice', [OrderController::class, 'show'])->name('orders.show');

require __DIR__.'/auth.php';
require __DIR__.'/superadmin.php';
