<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SuperAdminController;
use App\View\Components\QrCode;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (auth()->user()?->role == 'superadmin') {
        return redirect()->route('superadmin.index');
    }
    return view('index');
});

Route::middleware('auth')->group(function () {
    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //restaurant
    Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurant.index');
    Route::post('/restaurants', [RestaurantController::class, 'store'])->name('restaurant.store');

    //order
    Route::get('orders', [OrderController::class, 'order'])->name('order.order');

    //category
    Route::post('categories', [CategoryController::class, 'store'])->name('category.store');

    //section
    Route::post('sections', [SectionController::class, 'store'])->name('section.store');

    Route::get('dashboard', [AdminDashboardController::class, '__invoke'])->name('dashboard.index');

    Route::delete('items/{item}', [ItemController::class, 'destroy'])->name('item.destroy');
});

Route::middleware('auth.custom')->group(function (){
    Route::get('/restaurants/{restaurant}/menu', [RestaurantController::class, 'menu'])->name('restaurant.menu');

    Route::get('/restaurants/{restaurant}/menu/{category}/items', [CategoryController::class, 'show'])->name('category.show');
    Route::get('/restaurants/{restaurant}/sections/{section}/categories', [CategoryController::class, 'index'])->name('category.index');

    Route::post('/items', [ItemController::class, 'store'])->name('item.store');
    Route::get('/categories/{category}/items', [ItemController::class, 'index'])->name('item.index');
    Route::get('/items/{itemIDs}', [ItemController::class, 'list'])->name('item.list');

    Route::get('/restaurants/{restaurant}/show-my-order', [OrderController::class, 'index'])->name('order.index');
    Route::post('/restaurants/{restaurant}/checkout', [OrderController::class, 'store'])->name('order.store');
    Route::get('/restaurants/{order}/invoice', [OrderController::class, 'show'])->name('order.show');

    Route::get('/qr/{restaurant}', [QrCodeController::class, 'index'])->name('qr.redirect');

    Route::post('/image-control', [ImageController::class, 'store'])->name('image-control.store');
    Route::get('/image-control', [ImageController::class, 'index'])->name('image-control.index');
});

Route::middleware(['auth', 'auth.superadmin'])->group(function () {
    Route::get('superadmin', [SuperAdminController::class, 'index'])->name('superadmin.index');
    Route::get('superadmin/users', [SuperAdminController::class, 'users'])->name('superadmin.users');
    Route::get('superadmin/restaurants', [SuperAdminController::class, 'restaurants'])->name('superadmin.restaurants');
});

// test route
Route::get('/test', [ImageController::class, 'index'])->name('test');
Route::get('/qr', [QrCode::class, 'render'])->name('qr');

require __DIR__.'/auth.php';
