<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StatisticsController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ReviewController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware(['auth', 'admin'])->group(function () {
    // get stats
    Route::resource('users.statistics', StatisticsController::class);
    // get payment stauts
    Route::get('orders/{order}/payment-status', [OrderController::class, 'paymentStatus'])->name('orders.payment-status');
    // qr pay
    Route::get('orders/{order}/qr-pay', [OrderController::class, 'qrPay'])->name('orders.qr-pay')->name('orders.qr-pay');
    // reviews
    Route::resource('reviews', ReviewController::class);
    // orders name api.orders.index
    Route::get('orders', [OrderController::class, 'index'])->name('api.orders.index');
// });
