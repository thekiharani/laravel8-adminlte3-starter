<?php

use App\Http\Controllers\Payments\MpesaController;
use Illuminate\Support\Facades\Route;


// access token
Route::post('access_token', [MpesaController::class, 'generateAccessToken'])->name('payments.access_token');

// c2b
Route::post('validation_url', [MpesaController::class, 'c2bValidation'])->name('payments.validation_url');
Route::post('confirmation_url', [MpesaController::class, 'c2bConfirmation'])->name('payments.confirmation_url');
Route::post('registerUrl', [MpesaController::class, 'c2bRegisterUrls'])->name('payments.register_urls');
Route::post('c2b_simulate', [MpesaController::class, 'c2bSimulate'])->name('c2b_simulate');

// stk push
Route::post('stk_init', [MpesaController::class, 'stkInit'])->name('payments.stk_init');
Route::post('stk_save', [MpesaController::class, 'stkSave'])->name('payments.stk_save');
