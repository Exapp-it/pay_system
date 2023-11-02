<?php

namespace App\Http\Controllers;

use App\Http\Services\MerchantService;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MerchantHandlerController extends Controller
{
    public function handler(Request $request): string
    {
        if (
            $request->post('id') !== null &&
            $request->post('order') !== null &&
            $request->post('amount') !== null &&
            $request->post('currency') !== null &&
            $request->post('signature') !== null
        ) {

            $service = new MerchantService($request);

            dd($request->all());

            if ($service->getHash() === $request->input('hash')) {
                return 'Hash verified';
            }

            return "hash error";
        }
        return 'Error order';
    }

    public function test(): void
    {
$m_shop = '1970626524';
$m_orderid = '1';
$m_amount = number_format(100, 2, '.', '');
$m_curr = 'USD';
$m_key = 'Ваш секретный ключ';

$arHash = array(
	$m_shop,
	$m_orderid,
	$m_amount,
	$m_curr,
);


$arHash[] = $m_key;

$sign = strtoupper(hash('sha256', implode(':', $arHash)));
echo '<form method="post" action="'.route('merchant.handler').'">
<input type="hidden" name="m_shop" value="'.$m_shop.'">
<input type="hidden" name="m_orderid" value="'.$m_orderid.'">
<input type="hidden" name="m_amount" value="'.$m_amount.'">
<input type="hidden" name="m_curr" value="'.$m_curr.'">
<input type="hidden" name="m_sign" value="'.$sign.'">
<input type="hidden" name="form[curr[2609]]" value="USD">
<input type="submit" name="m_process" value="send" />
</form>';
    }
}
