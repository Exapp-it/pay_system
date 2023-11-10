<?php

use App\Http\Controllers\MerchantController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WithdrawalController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('user.index');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('edit', [ProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::put('update', [ProfileController::class, 'update'])
            ->name('profile.update');

        Route::post('updateContacts', [ProfileController::class, 'updateContacts'])
            ->name('profile.update.contact');

        Route::delete('destroy', [ProfileController::class, 'destroy'])
            ->name('profile.destroy');
    });

    Route::prefix('merchant')->group(function () {
        Route::get('', [MerchantController::class, 'index'])
            ->name('merchant');

        Route::get('{id}/show', [MerchantController::class, 'show'])
            ->name('merchant.show');

        Route::get('create', [MerchantController::class, 'create'])
            ->name('merchant.create');

        Route::post('store', [MerchantController::class, 'store'])
            ->name('merchant.store');

        Route::post('{id}/activate', [MerchantController::class, 'activateOrDeactivate'])
            ->name('merchant.activate');

        Route::post('{id}/delete', [MerchantController::class, 'destroy'])
            ->name('merchant.destroy');
    });

    Route::prefix('withdrawal')->group(function () {
        Route::get('create', [WithdrawalController::class, 'create'])
            ->name('user.withdrawal.create');

        Route::post('store', [WithdrawalController::class, 'store'])
            ->name('user.withdrawal.store');
    });

    Route::get('orders', [OrderController::class, 'index'])
        ->name('user.orders');

});
