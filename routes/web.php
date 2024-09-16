<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Front\ExchangeRateController;
use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::get('/', [ExchangeRateController::class, 'index'])->name('index');
    Route::post('/exchange/convert', [ExchangeRateController::class, 'convert'])->name('exchange.convert');
});

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    });

// Auth Routes
require __DIR__.'/auth.php';
