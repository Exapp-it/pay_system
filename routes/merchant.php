<?php

use App\Http\Controllers\MerchantController;
use App\Http\Controllers\MerchantHandlerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('', [MerchantController::class, 'index'])->name('merchant');
    Route::get('{id}/show', [MerchantController::class, 'show'])->name('merchant.show');
    Route::get('create', [MerchantController::class, 'create'])->name('merchant.create');
    Route::post('store', [MerchantController::class, 'store'])->name('merchant.store');
    Route::post('{id}/activate', [MerchantController::class, 'activateOrDeactivate'])->name('merchant.activate');
    Route::post('{id}/delete', [MerchantController::class, 'destroy'])->name('merchant.destroy');
});

Route::post('handler', [MerchantHandlerController::class, 'handler'])
    ->middleware('merchant')
    ->name('merchant.handler');

Route::get('test', [TestController::class, 'test'])->name('merchant.test');
