<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class  TestController extends Controller
{
    public function test(): void
    {
        $shop = '190916925350';
        $order = '1';
        $amount = number_format(100, 2, '.', '');
        $currency = 'RUB';
        $key = 'mEbZKIF5#3c0I82w5LFAdQzTMOW4F7VV';

        $data = [
            $shop,
            $order,
            $amount,
            $currency,
            $key,
        ];

        $hashString = implode(':', $data);
        $hashedValue = hash('sha256', $hashString);

        $signature = strtoupper($hashedValue);

        echo(
            '<form method="post" action="http://127.0.0.1:8000/api">
                <input type="text" name="shop" value="' . $shop . '">
                <input type="text" name="order" value="' . $order . '">
                <input type="text" name="amount" value="' . $amount . '">
                <input type="text" name="currency" value="' . $currency . '">
                <input type="text" name="signature" value="' . $signature . '">
                <input type="submit" name="handler" value="process" />
            </form>');
    }
}
