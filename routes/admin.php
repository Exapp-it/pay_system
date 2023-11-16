<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MerchantController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PaymentSystemController;
use App\Http\Controllers\Admin\PSInfoController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\WithdrawalController;
use Illuminate\Support\Facades\Route;


Route::middleware('admin.auth')->group(function () {
    Route::get('/', [MainController::class, 'index'])
        ->name('admin');

    Route::get('users', [MainController::class, 'users'])
        ->name('admin.users');

    Route::get('history', [MainController::class, 'history'])
        ->name('admin.history');

    Route::get('{id}/transaction', [MainController::class, 'transaction'])
        ->name('admin.transaction');

    Route::get('logout', [LoginController::class, 'destroy'])
        ->name('admin.logout');


    Route::prefix('merchant')->group(function () {

        Route::get('', [MerchantController::class, 'index'])
            ->name('admin.merchant');

        Route::get('{id}/show', [MerchantController::class, 'show'])
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
    });


    Route::prefix('pay-systems')->group(function () {

        Route::get('', [PaymentSystemController::class, 'index'])
            ->name('admin.ps');

        Route::get('create', [PaymentSystemController::class, 'create'])
            ->name('admin.ps.create');

        Route::post('store', [PaymentSystemController::class, 'store'])
            ->name('admin.ps.store');

        Route::get('{id}/edit', [PaymentSystemController::class, 'edit'])
            ->name('admin.ps.edit');

        Route::post('{id}/update', [PaymentSystemController::class, 'update'])
            ->name('admin.ps.update');

        Route::post('{id}/change', [PaymentSystemController::class, 'changeStatus'])
            ->name('admin.ps.change');

        Route::get('info', [PSInfoController::class, 'index'])
            ->name('admin.ps.info');

        Route::get('{id}/info', [PSInfoController::class, 'show'])
            ->name('admin.ps.info.show');

        Route::get('info/create', [PSInfoController::class, 'create'])
            ->name('admin.ps.info.create');

        Route::post('info/create', [PSInfoController::class, 'store'])
            ->name('admin.ps.info.store');

        Route::post('{id}/info/change', [PSInfoController::class, 'change'])
            ->name('admin.ps.info.change');

        Route::post('{id}/info/delete', [PSInfoController::class, 'destroy'])
            ->name('admin.ps.info.delete');

        Route::get('{id}/info/edit', [PSInfoController::class, 'edit'])
            ->name('admin.ps.info.edit');

        Route::post('{id}/info/update', [PSInfoController::class, 'update'])
            ->name('admin.ps.info.update');
    });


    Route::prefix('payments')->group(function () {

        Route::get('', [PaymentController::class, 'index'])
            ->name('admin.payments');

        Route::get('fetch', [PaymentController::class, 'fetch'])
            ->name('admin.payments.fetch');


        Route::post('{id}/approve', [PaymentController::class, 'approve'])
            ->name('admin.payment.approve');

        Route::post('{id}/reject', [PaymentController::class, 'reject'])
            ->name('admin.payment.reject');
    });

    Route::prefix('withdrawal')->group(function () {
        Route::get('', [WithdrawalController::class, 'index'])
            ->name('admin.withdrawal');

        Route::post('{id}/approve', [WithdrawalController::class, 'approve'])
            ->name('admin.withdrawal.approve');

        Route::post('{id}/reject', [WithdrawalController::class, 'reject'])
            ->name('admin.withdrawal.reject');
    });
});

Route::middleware('guest:admin')->group(function () {
    Route::get('login', [LoginController::class, 'index'])
        ->name('admin.login');

    Route::post('login', [LoginController::class, 'store'])
        ->name('admin.login.store');
});


