<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentSystem;
use App\Models\PSInfo;
use App\Services\PaymentSystemService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PSInfoController extends Controller
{
    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $psInfos = PSInfo::query()
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('admin.ps.info.index', ['psInfos' => $psInfos]);
    }

    /**
     * @param $id
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function show($id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $paySystem = PaymentSystem::find($id);

        return view('admin.ps.info.show', ['paySystem' => $paySystem]);
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $paySystems = PaymentSystem::all();

        return view('admin.ps.info.create', ['paySystems' => $paySystems]);
    }

    /**
     * @param $id
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function edit($id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $psInfo = PSInfo::find($id);

        return view('admin.ps.info.edit', ['psInfo' => $psInfo]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $psInfo = PSInfo::find($id);
        $psInfo->update($request->all());

        return redirect()->route('admin.ps.info.show', [$psInfo->paymentSystem->id]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $service = new PaymentSystemService($request);
        $service->validateInfo()->createInfo();

        return redirect()->route('admin.ps.info');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function change($id): \Illuminate\Http\RedirectResponse
    {
        $psInfo = PSInfo::find($id);
        $psInfo->activated = !$psInfo->activated;
        $psInfo->save();

        return back();
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $psInfo = PSInfo::find($id);
        $psInfo->delete();

        return back();
    }
}
