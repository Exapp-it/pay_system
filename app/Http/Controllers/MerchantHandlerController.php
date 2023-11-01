<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MerchantHandlerController extends Controller
{
    public function handler(Request $request)
    {
        $merchant = Merchant::where('m_id', $request->input('m_id'))->first();

        $m_id = $merchant->m_id;
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $m_key = $merchant->m_key;

        $hashData = [$m_id, $amount, $currency, $m_key];
        $string = implode(', ', $hashData);


        $hash = base64_encode($string);



        if($hash == $request->input('hash')) {
            return 'Hash verifed';
        }

        return  "hash error";
    }
}
