<?php


use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiHandlerController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::post('', ApiHandlerController::class)
    ->middleware('api');


Route::get('', [ApiController::class, 'index'])
    ->name('api.index');

Route::post('pay', [ApiController::class, 'pay'])
    ->name('api.pay');

Route::post('pay/{id}/send-order', [ApiController::class, 'sendOrder'])
    ->name('api.pay.sendOrder');

Route::post('pay/confirm', [ApiController::class, 'payConfirm'])
    ->name('api.pay.confirm');

Route::post('pay/{id}/confirm/manual', [ApiController::class, 'payConfirmManual'])
    ->name('api.pay.confirm.manual');

Route::get('redirect/{action}', [ApiController::class, 'redirect'])
    ->name('api.pay.redirect');


Route::get('test', [TestController::class, 'test'])->name('merchant.test');
