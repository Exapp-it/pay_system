<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\MainController;
use Illuminate\Support\Facades\Route;


Route::middleware('admin.auth')->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('admin');
    Route::get('logout', [LoginController::class, 'destroy'])->name('admin.logout');
});

Route::middleware('guest:admin')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('admin.login');
    Route::post('login', [LoginController::class, 'store'])->name('admin.login.store');
});


