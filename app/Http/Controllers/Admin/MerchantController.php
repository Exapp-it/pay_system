<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Carbon\Carbon;
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
        $merchants = Merchant::query()
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        $merchants->each(function ($merchant) {
            $totalTransactions = $merchant->payments()
                ->where('approved', true)
                ->whereDate('created_at', Carbon::today())
                ->sum('amount_default_currency');

            $merchant->totalTransactions = $totalTransactions;
        });

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

    public function percent(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'percent' => ['required', 'numeric'],
        ]);
        $merchant = Merchant::find($id);
        $merchant->percent = $request->post('percent');
        $merchant->save();

        return back();
    }

    private function getTotalTransactionsForMerchants($merchants): int
    {
        $currentDate = Carbon::today();
        $totalTransactions = 0;

        foreach ($merchants as $merchant) {
            $totalTransactions += $merchant->transactions()
                ->whereDate('created_at', $currentDate)
                ->sum('amount');
        }

        return $totalTransactions;
    }
}
