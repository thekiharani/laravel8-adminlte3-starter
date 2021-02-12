<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasswordController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', DashboardController::class)
        ->middleware(['password.confirm'])
        ->name('dashboard');
    Route::get('password/change', [PasswordController::class, 'index'])->name('password.change');
    Route::patch('password/update', [PasswordController::class, 'patch'])->name('password.patch');
});
