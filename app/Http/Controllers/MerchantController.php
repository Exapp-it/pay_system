<?php

namespace App\Http\Controllers;

use App\Http\Services\MerchantService;
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
        $merchants = Merchant::where('user_id', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('merchant.index', ['merchants' => $merchants]);
    }

    /**
     * @param $id
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function show($id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $merchant = Merchant::where('m_id', $id)->first();

        return view('merchant.show', ['merchant' => $merchant]);
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function add(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('merchant.add');
    }

    /**
     * @param Request $request
     * @return string
     */
    public function store(Request $request): string
    {
        $service = new MerchantService($request);

        $service->validate()->create();

        return 'OK';
    }

    /**
     * @param $id
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function edit($id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $merchant = Merchant::where('m_id', $id)->first();

        return view('merchant.edit', ['merchant' => $merchant]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        Merchant::where('m_id', $id)->update(['title' => $request->input('title')]);

        return redirect()->route('merchant.edit', ['id' => $id]);
    }
}
