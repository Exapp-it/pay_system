<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Withdrawal;
use App\Services\ExchangeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = Withdrawal::query()->paginate(10);

        return view('admin.withdrawal', ['withdrawals' => $withdrawals]);
    }

    public function approve(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $withdrawal = Withdrawal::find($id);
        $withdrawal->approved = true;
        $withdrawal->save();

        $transaction = $withdrawal->transaction;
        $transaction->confirmed = true;
        $transaction->save();

        return back();
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function reject($id): RedirectResponse
    {
        $withdrawal = Withdrawal::find($id);
        $withdrawal->canceled = true;
        $withdrawal->save();

        $transaction = $withdrawal->transaction;
        $transaction->canceled = true;
        $transaction->save();

        $currencies = config('payment.currencies');
        $currentCurrency = $transaction->currency;
        $defaultCurrency = config('payment.default_currency.name');
        $amountDefaultCurrency = $transaction->amount;

        if ($currentCurrency !== $defaultCurrency) {
            $type = collect($currencies)->filter(function ($currencyArray) use ($currentCurrency) {
                return in_array($currentCurrency, $currencyArray);
            })->keys()->first();

            $amountUSD = $transaction->amount;
            if ($currentCurrency !== 'USD') {
                $amountUSD = ExchangeService::toUSD($transaction->amount, $currentCurrency, $type);
            }
            $amountDefaultCurrency = ExchangeService::toDefaultCurrency($amountUSD);
        }

        $merchant = $transaction->merchant;
        $merchant->balance += $amountDefaultCurrency;
        $merchant->save();

        return back();
    }
}
