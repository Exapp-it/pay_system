<?php

namespace App\Services;

class ExchangeService
{
    /**
     * @param $amount
     * @return string
     */
    public static function toDefaultCurrency($amount): string
    {
        $rate = CurrencyApiService::getFiatRate('USD', config('payment.default_currency.name'));
        $convertedAmount = ($amount * $rate);

        return sprintf('%.2f', $convertedAmount);
    }

    /**
     * @param $amount
     * @return string
     */
    public static function fromDefaultCurrency($amount): string
    {
        $rate = CurrencyApiService::getFiatRate(config('payment.default_currency.name'), 'USD');
        $convertedAmount = ($amount * $rate);

        return sprintf('%.2f', $convertedAmount);
    }

    /**
     * @param $amount
     * @param $currency
     * @param string $type
     * @return string
     */
    public static function toUSD($amount, $currency, string $type = 'fiat'): string
    {
        $rate = 1;

        if ($type === 'fiat') {
            $rate = CurrencyApiService::getFiatRate($currency, 'USD');
        } elseif ($type === 'crypto') {
            $rate = CurrencyApiService::getCryptoRate($currency, 'USDT');
        }

        $convertedAmount = ($amount * $rate);

        return sprintf('%.2f', $convertedAmount);

    }

    /**
     * @param $amount
     * @param $currency
     * @param string $type
     * @return string
     */
    public static function fromUSD($amount, $currency, string $type = 'fiat'): string
    {
        $rate = 1;

        if ($type === 'fiat') {
            $rate = CurrencyApiService::getFiatRate('USD', $currency);
        } elseif ($type === 'crypto') {
            $rate = CurrencyApiService::getCryptoRate($currency, 'USDT');
        }

        $convertedAmount = ($amount * $rate);

        return sprintf('%.2f', $convertedAmount);

    }
}
