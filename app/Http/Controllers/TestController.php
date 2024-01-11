<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Transaction;
use Carbon\Carbon;

class  TestController extends Controller
{


    public function transaction($id)
    {


        return inertia('Admin/Transaction', [
            'title' => 'Транзакция - ' . $id,
            'order' => Transaction::find($id),
        ]);
    }

    public function payments()
    {
        $payments = Payment::query()
            ->with('transaction')
            ->with('system')
            ->with('merchant')
            ->orderByDesc('created_at')
            ->paginate(3);


        return inertia('Admin/Payments', [
            'title' => 'Платежи',
            'payments' => $payments,
        ]);
    }

    public function paymentsUpdate()
    {
        $lastUpdated = Carbon::now();

        $payments = Payment::query()
            ->with('transaction')
            ->with('system')
            ->with('merchant')
            ->orderByDesc('created_at')
            ->paginate(3);

        return response()->json(['payments' => $payments]);
    }

//    public function test(): void
//    {
//        $currencies = config('payment.currencies');
//        $currentCurrency = 'USD';
//        $defaultCurrency = config('payment.default_currency.name');
//        $amountDefaultCurrency = 250;
//
//        if ($currentCurrency !== $defaultCurrency) {
//            $type = collect($currencies)->filter(function ($currencyArray) use ($currentCurrency) {
//                return in_array($currentCurrency, $currencyArray);
//            })->keys()->first();
//
//            $amountUSD = $amountDefaultCurrency;
//
//            if ($currentCurrency !== 'USD' && $currentCurrency !== 'USDT') {
//                $amountUSD = ExchangeService::fromUSD($amountDefaultCurrency, $currentCurrency, $type);
//            }
//            $amountCurrentCurrency = ExchangeService::fromDefaultCurrency($amountUSD);
//        }
//
//        dd($amountCurrentCurrency);
//
//
//    }
}
