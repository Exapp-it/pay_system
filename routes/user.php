<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('user.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('update', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('updateContacts', [ProfileController::class, 'updateContacts'])->name('profile.update.contact');
        Route::delete('destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});
