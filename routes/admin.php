<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MerchantController;
use App\Http\Controllers\Admin\PaymentSystemController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;


Route::middleware('admin.auth')->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('admin');
    Route::get('users', [UsersController::class, 'all'])->name('admin.users');
    Route::get('logout', [LoginController::class, 'destroy'])->name('admin.logout');

    Route::get('merchant', [MerchantController::class, 'index'])->name('admin.merchant');
    Route::get('{id}/merchant', [MerchantController::class, 'show'])->name('admin.merchant.show');
    Route::post('{id}/approve', [MerchantController::class, 'approve'])->name('admin.merchant.approve');
    Route::post('{id}/reject', [MerchantController::class, 'reject'])->name('admin.merchant.reject');
    Route::post('{id}/block', [MerchantController::class, 'block'])->name('admin.merchant.block');
    Route::post('{id}/unlock', [MerchantController::class, 'unlock'])->name('admin.merchant.unlock');

    Route::get('pay-systems', [PaymentSystemController::class, 'index'])->name('admin.ps');
    Route::get('pay-systems/create', [PaymentSystemController::class, 'create'])->name('admin.ps.create');
    Route::post('pay-systems/store', [PaymentSystemController::class, 'store'])->name('admin.ps.store');
});

Route::middleware('guest:admin')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('admin.login');
    Route::post('login', [LoginController::class, 'store'])->name('admin.login.store');
});


