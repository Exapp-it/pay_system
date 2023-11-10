<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Services\ExchangeService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $payments = Payment::query()
            ->whereNotNull('pay_screen')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('admin.payments', ['payments' => $payments]);
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
            if ($currentCurrency !== 'USD') {
                $amountUSD = ExchangeService::toUSD($payment->amount, $currentCurrency, $type);
            }
            $amountDefaultCurrency = ExchangeService::toDefaultCurrency($amountUSD);
        }

        $merchant = $payment->merchant;
        $merchant->balance += $amountDefaultCurrency;
        $merchant->save();

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
