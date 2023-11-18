<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('vue', [TestController::class, 'index']);





