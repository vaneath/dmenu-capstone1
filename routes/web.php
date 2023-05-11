<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/restaurant', [RestaurantController::class, 'index'])->name('restaurant.index');
    Route::post('/restaurant', [RestaurantController::class, 'store'])->name('restaurant.store');
});

// test route
Route::get('/test', function () {
    return view('tests.modal');
});

require __DIR__.'/auth.php';
