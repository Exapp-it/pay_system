<?php


use App\Http\Controllers\ApiController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::post('', [ApiController::class, 'handler'])
    ->middleware('api')
    ->name('api');

Route::get('', [ApiController::class, 'index'])
    ->name('api');

Route::post('create/{id}', [ApiController::class, 'create'])
    ->name('api.create');


Route::get('test', [TestController::class, 'test'])->name('merchant.test');
