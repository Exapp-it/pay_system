<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function create()
    {
        return view('user.withdrawal.create');
    }
}
