<?php

use App\Http\Controllers\MerchantController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'updateContacts'])->name('profile.update.contact');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Merchant 
    Route::prefix('merchant')->group(function () {
        Route::get('add', [MerchantController::class, 'index'])->name('merchant.add');
        Route::post('add', [MerchantController::class, 'store'])->name('merchant.store');
    });
});
