<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(): void
    {
        $shop = '760106531410';
        $order = '1';
        $amount = number_format(100, 2, '.', '');
        $currency = 'RUB';
        $key = ':TbUuVLoTvZtoWo3qI9TUGdl%ejyif?U';

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
            '<form method="post" action="' . route('merchant.handler') . '">
                <input type="text" name="shop" value="' . $shop . '">
                <input type="text" name="order" value="' . $order . '">
                <input type="text" name="amount" value="' . $amount . '">
                <input type="text" name="currency" value="' . $currency . '">
                <input type="text" name="signature" value="' . $signature . '">
                <input type="submit" name="handler" value="process" />
            </form>');
    }
}
