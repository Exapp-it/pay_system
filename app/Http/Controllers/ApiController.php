<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Payment;
use App\Models\PaymentSystem;
use App\Models\Transaction;
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


        $paymentId = Payment::create([
            'm_id' => $merchant->m_id,
            'amount' => $request->get('amount'),
            'currency' => $request->get('currency'),
            'order' => $request->get('order'),
        ]);


        return view('api.index', [
            'data' => (object)$request->only('order', 'amount', 'currency'),
            'paymentId' => $paymentId,
            'paymentSystems' => $paymentSystems,
            'shop' => $merchant,
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function pay(Request $request, $id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
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

        Transaction::create([
            'm_id' => $payment->merchant->id,
            'amount' => $payment->amount,
            'currency' => $payment->currency,
            'type' => 'payIn',
        ]);

        return view('api.pay', [
            'paymentSystem' => $paymentSystem,
            'details' => $details,
            'payment' => $payment,
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse|string
     */
    public function handler(Request $request): JsonResponse|string
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
     * @param $message
     * @return JsonResponse
     */
    private function respondError($message): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ]);
    }
}
