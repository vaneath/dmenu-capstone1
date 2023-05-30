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

    Route::post('sections', [SectionController::class, 'store'])->name('section.store');

    Route::get('dashboard', [AdminDashboardController::class, '__invoke'])->name('dashboard.index');
});

Route::middleware('auth.custom')->group(function (){
    Route::get('/qr/{restaurant}', [QrCodeController::class, 'index'])->name('qr.redirect');
    Route::get('/restaurants/{restaurant}/menu', [RestaurantController::class, 'menu'])->name('restaurant.menu');
    Route::get('/restaurants/{restaurant}/show-my-order', [OrderController::class, 'index'])->name('order.index');
    Route::post('/restaurants/{restaurant}/checkout-v2', [OrderController::class, 'store'])->name('order.store');
    Route::get('/restaurants/{restaurant}/checkout', [OrderController::class, 'show'])->name('order.show');
    Route::get('/restaurants/{restaurant}/menu/{category}/items', [CategoryController::class, 'show'])->name('category.show');
    Route::post('/items', [ItemController::class, 'store'])->name('item.store');
    Route::get('/restaurants/{restaurant}/sections/{section}/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/categories/{category}/items', [ItemController::class, 'index'])->name('item.index');

    Route::post('/images', [ImageController::class, 'store'])->name('images.store');
    Route::get('/images', [ImageController::class, 'index'])->name('images.index');
});

Route::middleware(['auth', 'auth.superadmin'])->group(function () {
    Route::get('superadmin', [SuperAdminController::class, 'index'])->name('superadmin.index');
    Route::get('superadmin/users', [SuperAdminController::class, 'users'])->name('superadmin.users');
    Route::get('superadmin/restaurants', [SuperAdminController::class, 'restaurants'])->name('superadmin.restaurants');
});

// test route
Route::get('/test', function () {
    return view('tests.modal');
});

Route::get('/qr', [QrCode::class, 'render'])->name('qr');

require __DIR__.'/auth.php';
