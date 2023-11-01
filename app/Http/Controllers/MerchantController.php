<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function index()
    {
        return view('merchant.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required', 'string',
            'base_url' => 'required', 'string',
            'success_url' => 'required', 'string',
            'fail_url' => 'required', 'string',
            'handler_url' => 'required', 'string',
        ]);

        Merchant::create([
            'user_id' => $request->user()->id,
            'm_id' => Merchant::generateId(),
            'm_key' => Merchant::generateKey(),
            'title' => $request->input('title'),
            'base_url' => $request->input('base_url'),
            'success_url' => $request->input('success_url'),
            'fail_url' => $request->input('fail_url'),
            'handler_url' => $request->input('handler_url'),
        ]);
    }
}
