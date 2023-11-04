<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class MerchantController extends Controller
{

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $merchants = Merchant::query()->paginate(10);

        return view('admin.merchant.index', ['merchants' => $merchants]);
    }

    /**
     * @param $id
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function show($id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $merchant = Merchant::find($id);

        return view('admin.merchant.show', ['merchant' => $merchant]);
    }

    public function approve(Request $request, $id)
    {
        $merchant = Merchant::find($id);
        $merchant->moderation = !$merchant->moderation;
        $merchant->save();

        return back();
    }
}
