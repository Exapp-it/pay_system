<?php

namespace App\Http\Controllers;

use App\Http\Services\MerchantService;
use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function index()
    {
        $service = new MerchantService();

        return view('merchant.index', ['merchants' => $service->userMerchants()]);
    }

    public function add()
    {
        return view('merchant.add');
    }

    public function store(Request $request)
    {
        $service = new MerchantService($request);
        $service->validate()->create();
        return 'OK';
    }
}
