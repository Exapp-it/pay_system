<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $merchants = Merchant::where('user_id', auth()->user()->id)->get();
        $orders = [];

        foreach ($merchants as $merchant) {
            $orders = [...$merchant->transactions];
        }

        return view('user.orders', ['orders' => $orders]);
    }
}
