<?php

use App\Http\Controllers\MerchantHandlerController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::post('merchant/handler', [MerchantHandlerController::class, 'handler'])->name('merchant.handler');

Route::get('merchant/handler', function(){
return "
<form>

 </form>
";
});



