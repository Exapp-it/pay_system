<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
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

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function approve(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $merchant = Merchant::find($id);
        $merchant->approved = !$merchant->approved;
        $merchant->activated = true;
        $merchant->rejected = false;
        $merchant->banned = false;
        $merchant->save();

        return back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function reject(Request $request, $id): RedirectResponse
    {
        $merchant = Merchant::find($id);
        $merchant->rejected = true;
        $merchant->save();

        return back();
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function block($id): RedirectResponse
    {
        $merchant = Merchant::find($id);
        $merchant->activated = false;
        $merchant->banned = true;
        $merchant->save();

        return back();
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function unlock($id): RedirectResponse
    {
        $merchant = Merchant::find($id);
        $merchant->activated = true;
        $merchant->banned = false;
        $merchant->save();

        return back();
    }
}
