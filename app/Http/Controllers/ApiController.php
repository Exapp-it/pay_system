<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Payment;
use App\Models\PaymentSystem;
use App\Services\ApiService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    /**
     * @param Request $request
     * @return View|Application|Factory|JsonResponse|\Illuminate\Contracts\Foundation\Application
     */
    public function index(Request $request): View|Application|Factory|JsonResponse|\Illuminate\Contracts\Foundation\Application
    {
        $merchant = Merchant::approvedAndActivated()
            ->where('m_id', $request->get('shop'))
            ->first();

        $service = new ApiService($request, $merchant);

        $service->validate();

        if (!$service->merchantExists()) {
            return $this->respondError(__('Merchant not found'));
        }

        if (!$service->verifyHash()) {
            return $this->respondError(__('Hash no verified'));
        }

        $paymentSystems = PaymentSystem::query()
            ->where('currency', $request->only('currency'))
            ->where('activated', true)
            ->get();


        $paymentId = $service->createPayment();


        return view('api.index', [
            'data' => (object)$request->only('order', 'amount', 'currency'),
            'paymentId' => $paymentId,
            'paymentSystems' => $paymentSystems,
            'shop' => $merchant,
        ]);
    }

    public function create(Request $request, $id)
    {
        $request->validate([
            'payment_system' => ['required'],
        ]);

        $paymentSystem = PaymentSystem::find($request->post('payment_system'));
        $payment = Payment::find($id);
        $payment->payment_system = $paymentSystem->id;
        $payment->save();

        $details = $paymentSystem->infos->reduce(function ($carry, $info) {
            if ($carry === null || $info->usage_count < $carry->usage_count) {
                return $info;
            }
            return $carry;
        }, null);

        return view('api.create', [
            'paymentSystem' => $paymentSystem,
            'details' => $details,
            'payment' => $payment,
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

        $service = new ApiService($request, $merchant);

        $service->validate();

        if (!$service->merchantExists()) {
            return $this->respondError(__('Merchant not found'));
        }

        if (!$service->verifyHash()) {
            return $this->respondError(__('Hash no verified'));
        }

        return redirect()->route('api', $request->all());
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
}
