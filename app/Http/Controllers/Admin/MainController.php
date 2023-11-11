<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $statistics = collect([
            'countUser' => User::all()->count(),
            'countMerchant' => Merchant::all()->count(),
//            'sumPayments' => Merchant::all()->count(),
//            'countMerchant' => Merchant::all()->count(),
        ]);
        $statistics = (object)$statistics->all();

        return view('admin.index', ['statistics' => $statistics]);
    }


}
