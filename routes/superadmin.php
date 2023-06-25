<?php

use App\Http\Controllers\SuperAdminController;
use App\Http\Middleware\SuperAdmin;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'superadmin'])->group(function () {
    Route::get('/superadmin', [SuperAdminController::class, 'index'])->name('superadmin.index');
    Route::get('/superadmin/users', [SuperAdminController::class, 'users'])->name('superadmin.users');
    Route::get('/superadmin/restaurants', [SuperAdminController::class, 'restaurants'])->name('superadmin.restaurants');
    Route::get('/superadmin/orders', [SuperAdminController::class, 'orders'])->name('superadmin.orders');
});;
