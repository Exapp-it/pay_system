<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MerchantController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;


Route::middleware('admin.auth')->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('admin');
    Route::get('users', [UsersController::class, 'all'])->name('admin.users');
    Route::get('logout', [LoginController::class, 'destroy'])->name('admin.logout');

    Route::get('merchant', [MerchantController::class, 'index'])->name('admin.merchant');
    Route::get('{id}/merchant', [MerchantController::class, 'show'])->name('admin.merchant.show');
    Route::put('{id}/approve', [MerchantController::class, 'approve'])->name('admin.merchant.approve');
});

Route::middleware('guest:admin')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('admin.login');
    Route::post('login', [LoginController::class, 'store'])->name('admin.login.store');
});


