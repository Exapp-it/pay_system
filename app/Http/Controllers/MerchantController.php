<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Services\MerchantService;
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
            ->paginate(10);

        return view('merchant.index', ['merchants' => $merchants]);
    }


    /**
     * @param $id
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function show($id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $merchant = Merchant::find($id);

        return view('merchant.show', ['merchant' => $merchant]);
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('merchant.create');
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $service = new MerchantService($request);
        $merchant = $service->validate()->create();

        return redirect()->to(route('merchant.show', [$merchant->id]));
    }


    /**
     * @param $id
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function edit($id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $merchant = Merchant::find($id);

        return view('merchant.edit', ['merchant' => $merchant]);
    }

    public function update(Request $request, $id)
    {
        $merchant = Merchant::find($id);
        $merchant->update($request->all());

        return back();
    }


    /**
     * @param $id
     * @return RedirectResponse
     */
    public function activateOrDeactivate($id): RedirectResponse
    {
        $merchant = Merchant::find($id);
        $merchant->activated = !$merchant->activated;
        $merchant->save();

        return back();
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $merchant = Merchant::find($id);
        $merchant->delete();

        return redirect()->route('merchant');
    }

}
