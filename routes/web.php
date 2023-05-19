<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\SectionController;
use App\View\Components\QrCode;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

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
    return view('index');
});

Route::middleware('auth')->group(function () {

    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //restaurants
    Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurant.index');
//    Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show'])->name('restaurant.show');
    Route::post('/restaurants', [RestaurantController::class, 'store'])->name('restaurant.store');

    //category
    Route::get('restaurants/{restaurant}', [CategoryController::class, 'index'])->name('category.index');
    Route::post('categories', [CategoryController::class, 'store'])->name('category.store');

    Route::post('sections', [SectionController::class, 'store'])->name('section.store');

    Route::get('categories/{category}/items', [ItemController::class, 'index'])->name('item.index');
});

// Route::post('/restaurants', [RestaurantController::class, 'store'])->name('restaurant.store');

// test route
Route::get('/test', function () {
    return view('tests.modal');
});

Route::get('/qr', [QrCode::class, 'render'])->name('qr');

Route::get('/customer', [RestaurantController::class, 'show'])->middleware('guest');

require __DIR__.'/auth.php';
