<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentSystem;
use App\Services\FileUploadService;
use App\Services\PaymentSystemService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentSystemController extends Controller
{
    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $paySystems = PaymentSystem::orderBy('created_at', 'DESC')->get();

        return view('admin.ps.index', ['paySystems' => $paySystems]);
    }


    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $fiatCurrencies = config('payment.currencies.fiat');
        $cryptoCurrencies = config('payment.currencies.crypto');
        $currencies = [...$fiatCurrencies, ...$cryptoCurrencies];

        return view('admin.ps.create', ['currencies' => $currencies]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $service = new PaymentSystemService($request);
        $service->validate()->create();

        return redirect()->route('admin.ps');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function changeStatus($id): RedirectResponse
    {
        $paySystem = PaymentSystem::find($id);
        $paySystem->activated = !$paySystem->activated;
        $paySystem->save();

        return back();
    }

    /**
     * @param $id
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function edit($id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $paySystem = PaymentSystem::find($id);

        return view('admin.ps.edit', ['paySystem' => $paySystem]);
    }

    public function update(Request $request, $id)
    {
        $service = new PaymentSystemService($request);
        $service->update((int)$id);

        return back();

    }

}
