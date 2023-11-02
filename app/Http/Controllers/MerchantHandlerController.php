<?php

namespace App\Http\Controllers;

use App\Http\Services\MerchantHandlerService;
use App\Models\Merchant;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MerchantHandlerController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse|string
     */
    public function handler(Request $request): \Illuminate\Http\JsonResponse|string
    {
        $merchant = Merchant::activeAndModerated()
            ->where('m_id', $request->post('shop'))
            ->first();

        $service = new MerchantHandlerService($request);

        $service->setMerchant($merchant);
        $service->validate();

        if (!$service->isProcess()) {
            return $this->respondError('Process Error');
        }

        if (!$service->merchantExists()) {
            return $this->respondError('Merchant not found');
        }

        if (!$service->verifyHash()) {
            return $this->respondError('Hash no verified');
        }

        $payment = $service->createPayment();
        $transaction = $service->addTransaction($payment);
        return $this->respondSuccess($transaction);
    }

    /**
     * @param $transaction
     * @return JsonResponse
     */
    private function respondSuccess($transaction): \Illuminate\Http\JsonResponse
    {
        $payment = $transaction->payment()->first();

        return response()->json([
            'status' => 'success',
            'message' => 'ok',
            'data' => [
                'operation_id' => $transaction->id,
                'operation_pay_system' => $payment->payment_system,
                'operation_date' => $transaction->created_at->format('Y-m-d H:i:s'),
                'operation_pay_date' => $transaction->updated_at->format('Y-m-d H:i:s'),
                'shop' => $payment->m_id,
                'amount' => $transaction->amount,
                'currency' => $transaction->currency,
            ]
        ]);
    }

    /**
     * @param $message
     * @return JsonResponse
     */
    private function respondError($message): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => [],
        ]);
    }
}
