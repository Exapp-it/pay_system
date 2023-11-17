<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Services\ExchangeService;
use App\Services\PaymentService;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class PaymentController extends Controller
{
    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): Application|Factory|View|\Illuminate\Contracts\Foundation\Application
    {
        $payments = Payment::whereNotNull('pay_screen')
            ->with('transaction')
            ->with('system')
            ->orderBy('updated_at', 'DESC')
            ->paginate(10);

        return view('admin.payments', ['payments' => $payments]);
    }


    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
// Ваш метод в контроллере
    public function fetch(Request $request)
    {
        $lastUpdated = $request->input('last_updated');

        $lastUpdated = Carbon::parse($lastUpdated);

        $newPayments = Payment::whereNotNull('pay_screen')
            ->with('transaction')
            ->with('system')
            ->with('merchant')
            ->where('updated_at', '>', $lastUpdated)
            ->get();

        return response()->json(['newPayments' => $newPayments]);
    }


    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function approve(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $payment = Payment::find($id);
        $payment->approved = true;
        $payment->save();

        $transaction = $payment->transaction;
        $transaction->confirmed = true;
        $transaction->save();

        $currencies = config('payment.currencies');
        $currentCurrency = $payment->currency;
        $defaultCurrency = config('payment.default_currency.name');
        $amountDefaultCurrency = $payment->amount;

        if ($currentCurrency !== $defaultCurrency) {
            $type = collect($currencies)->filter(function ($currencyArray) use ($currentCurrency) {
                return in_array($currentCurrency, $currencyArray);
            })->keys()->first();

            $amountUSD = $payment->amount;
            if ($currentCurrency !== 'USD' && $currentCurrency !== 'USDT') {
                $amountUSD = ExchangeService::toUSD($payment->amount, $currentCurrency, $type);
            }
            $amountDefaultCurrency = ExchangeService::toDefaultCurrency($amountUSD);
        }

        $merchant = $payment->merchant;
        $merchant->balance += $amountDefaultCurrency;
        $merchant->save();

        $payment->amount_default_currency = $amountDefaultCurrency;
        $payment->save();
        PaymentService::sendAsyncRequest($transaction);

        return back();
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function reject($id): RedirectResponse
    {
        $payment = Payment::find($id);
        $payment->canceled = true;
        $payment->save();

        $transaction = $payment->transaction;
        $transaction->canceled = true;
        $transaction->save();

        return back();
    }
}
