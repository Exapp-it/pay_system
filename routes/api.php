<?php


use App\Http\Controllers\ApiController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::post('', [ApiController::class, 'handler'])
    ->middleware('api')
    ->name('api');

Route::get('', [ApiController::class, 'index'])
    ->name('api');

Route::get('pay/{id}', [ApiController::class, 'pay'])
    ->name('api.pay');

Route::post('pay/{id}/handler', [ApiController::class, 'payHandler'])
    ->name('api.pay.handler');


Route::get('test', [TestController::class, 'test'])->name('merchant.test');
