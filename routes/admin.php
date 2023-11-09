<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MerchantController;
use App\Http\Controllers\Admin\PaymentSystemController;
use App\Http\Controllers\Admin\PSInfoController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;


Route::middleware('admin.auth')->group(function () {
    Route::get('/', [MainController::class, 'index'])
        ->name('admin');

    Route::get('users', [UsersController::class, 'all'])
        ->name('admin.users');

    Route::get('logout', [LoginController::class, 'destroy'])
        ->name('admin.logout');


    Route::get('merchant', [MerchantController::class, 'index'])
        ->name('admin.merchant');

    Route::get('{id}/merchant', [MerchantController::class, 'show'])
        ->name('admin.merchant.show');

    Route::post('{id}/approve', [MerchantController::class, 'approve'])
        ->name('admin.merchant.approve');

    Route::post('{id}/percent', [MerchantController::class, 'percent'])
        ->name('admin.merchant.percent');

    Route::post('{id}/reject', [MerchantController::class, 'reject'])
        ->name('admin.merchant.reject');

    Route::post('{id}/block', [MerchantController::class, 'block'])
        ->name('admin.merchant.block');

    Route::post('{id}/unlock', [MerchantController::class, 'unlock'])
        ->name('admin.merchant.unlock');


    Route::get('pay-systems', [PaymentSystemController::class, 'index'])
        ->name('admin.ps');

    Route::get('pay-systems/create', [PaymentSystemController::class, 'create'])
        ->name('admin.ps.create');

    Route::post('pay-systems/store', [PaymentSystemController::class, 'store'])
        ->name('admin.ps.store');

    Route::get('pay-systems/{id}/edit', [PaymentSystemController::class, 'edit'])
        ->name('admin.ps.edit');

    Route::post('pay-systems/{id}/update', [PaymentSystemController::class, 'update'])
        ->name('admin.ps.update');

    Route::post('pay-systems/{id}/change', [PaymentSystemController::class, 'changeStatus'])
        ->name('admin.ps.change');


    Route::get('pay-system/info', [PSInfoController::class, 'index'])
        ->name('admin.ps.info');

    Route::get('pay-system/{id}/info', [PSInfoController::class, 'show'])
        ->name('admin.ps.info.show');

    Route::get('pay-system/info/create', [PSInfoController::class, 'create'])
        ->name('admin.ps.info.create');

    Route::post('pay-system/info/create', [PSInfoController::class, 'store'])
        ->name('admin.ps.info.store');

    Route::post('pay-system/{id}/info/change', [PSInfoController::class, 'change'])
        ->name('admin.ps.info.change');

    Route::post('pay-system/{id}/info/delete', [PSInfoController::class, 'destroy'])
        ->name('admin.ps.info.delete');

    Route::get('pay-system/{id}/info/edit', [PSInfoController::class, 'edit'])
        ->name('admin.ps.info.edit');

    Route::post('pay-system/{id}/info/update', [PSInfoController::class, 'update'])
        ->name('admin.ps.info.update');
});

Route::middleware('guest:admin')->group(function () {
    Route::get('login', [LoginController::class, 'index'])
        ->name('admin.login');

    Route::post('login', [LoginController::class, 'store'])
        ->name('admin.login.store');
});


