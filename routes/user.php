<?php

use App\Http\Controllers\MerchantController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('update', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('updateContacts', [ProfileController::class, 'updateContacts'])->name('profile.update.contact');
        Route::delete('destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::prefix('merchant')->group(function () {
        Route::get('', [MerchantController::class, 'index'])->name('merchant');
        Route::get('id/{id}', [MerchantController::class, 'show'])->name('merchant.show');
        Route::get('add', [MerchantController::class, 'add'])->name('merchant.add');
        Route::post('store', [MerchantController::class, 'store'])->name('merchant.store');
        Route::get('edit/{id}', [MerchantController::class, 'edit'])->name('merchant.edit');
        Route::put('update/{id}', [MerchantController::class, 'update'])->name('merchant.update');
    });
});
