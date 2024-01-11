<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('vue', [TestController::class, 'payments'])->name('vue.payments');
Route::get('vue/update', [TestController::class, 'paymentsUpdate'])->name('vue.payments.update');
Route::get('vue/transaction/{id}', [TestController::class, 'transaction'])->name('vue.transaction');





