<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\PaymentSystem;
use App\Services\ApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function index(Request $request)
    {
        $merchant = Merchant::approvedAndActivated()
            ->where('m_id', $request->get('shop'))
            ->first();

        $service = new ApiService($request, $merchant);

        if (!$service->merchantExists()) {
            return back()->with(['message' => __('Merchant not found')]);
        }

        $paymentSystems = PaymentSystem::query()
            ->where('currency', $request->only('currency'))
            ->where('activated', true)
            ->get();


        return view('api.index', [
            'data' => (object)$request->only('order', 'amount', 'currency'),
            'paymentSystems' => $paymentSystems,
            'shop' => $merchant,
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse|string
     */
    public function handler(Request $request): \Illuminate\Http\JsonResponse|string
    {

        $merchant = Merchant::approvedAndActivated()
            ->where('m_id', $request->post('shop'))
            ->first();


        return redirect()->route('api', $service->getData());
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
        ]);
    }

    private function check(Request $request, Merchant $merchant)
    {
        $service = new ApiService($request, $merchant);

        $service->validate();

        if (!$service->merchantExists()) {
            return $this->respondError(__('Merchant not found'));
        }

        if (!$service->verifyHash()) {
            return $this->respondError(__('Hash no verified'));
        }
    }
}
