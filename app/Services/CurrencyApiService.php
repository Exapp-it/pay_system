<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyApiService
{
    private static string $binanceUrl = 'https://api.binance.com/api/v3/ticker/price';
    private static string $openUrl = 'https://open.er-api.com/v6/latest';


    public static function getCryptoRate($fromCurrency, $toCurrency)
    {
        $symbol = strtoupper($fromCurrency . $toCurrency);
        $response = Http::get(self::$binanceUrl, ['symbol' => $symbol]);

        if ($response->successful()) {
            $data = $response->json();
            return $data['price'];
        }

        throw new \RuntimeException('Failed to fetch exchange rate from Binance.');
    }


    public static function getFiatRate($fromCurrency, $toCurrency)
    {
        $url = self::$openUrl;
        $response = Http::get("{$url}/{$fromCurrency}");

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['rates'][$toCurrency])) {
                return $data['rates'][$toCurrency];
            } else {
                throw new \RuntimeException('Invalid target currency.');
            }
        }

        throw new \RuntimeException('Failed to fetch exchange rate from Open Exchange Rates.');
    }
}
