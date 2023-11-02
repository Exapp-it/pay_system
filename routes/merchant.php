<?php

use App\Http\Controllers\MerchantController;
use App\Http\Controllers\MerchantHandlerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('', [MerchantController::class, 'index'])->name('merchant');
    Route::get('{id}/show', [MerchantController::class, 'show'])->name('merchant.show');
    Route::get('add', [MerchantController::class, 'add'])->name('merchant.add');
    Route::post('store', [MerchantController::class, 'store'])->name('merchant.store');
    Route::get('{id}/edit', [MerchantController::class, 'edit'])->name('merchant.edit');
    Route::put('{id}/update', [MerchantController::class, 'update'])->name('merchant.update');
});

Route::post('handler', [MerchantHandlerController::class, 'handler'])->name('merchant.handler');
Route::get('test', [TestController::class, 'test'])->name('merchant.test');
