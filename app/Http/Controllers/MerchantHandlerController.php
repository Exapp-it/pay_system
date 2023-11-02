<?php

namespace App\Http\Controllers;

use App\Http\Services\MerchantHandlerService;
use App\Http\Services\MerchantService;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class MerchantHandlerController extends Controller
{
    public function handler(Request $request)
    {
        $merchant = Merchant::withModeration()
            ->where('m_id', $request->post('id'))
            ->first();

        $service = new MerchantHandlerService($request);

        $service->setMerchant($merchant);
        $service->validate();

        if (!$service->isProcess()) {
            return 'Process Error';
        }

        if (!$service->merchantExists()) {
            return 'Merchant not found';
        }

        if (!$service->verifyHash()) {
            return 'Hash no verified';
        }

        return response()->json(['body' => 'Hash verified']);
    }

    public function test(): void
    {
        $id = '813500717006';
        $order = '1';
        $amount = number_format(100, 2, '.', '');
        $currency = 'RUB';
        $key = 'GQPq5cfmAjEgTajMvheKPVfAO5bO0vcC';

        $data = [
            $id,
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
                <input type="text" name="id" value="' . $id . '">
                <input type="text" name="order" value="' . $order . '">
                <input type="text" name="amount" value="' . $amount . '">
                <input type="text" name="currency" value="' . $currency . '">
                <input type="text" name="signature" value="' . $signature . '">
                <input type="submit" name="handler" value="process" />
            </form>');
    }

}
