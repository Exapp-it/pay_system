<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Services\MerchantHandlerService;
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
        $merchant = Merchant::approvedAndActivated()
            ->where('m_id', $request->post('shop'))
            ->first();

        $service = new MerchantHandlerService($request, $merchant);

        $service->validate();

        if (!$service->merchantExists()) {
            return $this->respondError('MerchantMiddleware not found');
        }

        if (!$service->verifyHash()) {
            return $this->respondError('Hash no verified');
        }

        return '1';
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
