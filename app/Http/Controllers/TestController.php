<?php

namespace App\Http\Controllers;

use App\Models\Payment;

class  TestController extends Controller
{

    public function index()
    {
        $payments = Payment::query()
            ->with('transaction')
            ->with('system')
            ->with('merchant')
            ->get();

        return inertia('Payments', [
            'title' => 'Vue testing',
            'payments' => $payments,
        ]);
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
