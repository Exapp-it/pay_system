<?php

namespace App\Http\Controllers;

use App\Models\ClientResponse;
use App\Models\Merchant;
use App\Models\Payment;
use App\Models\PaymentSystem;
use App\Models\Transaction;
use App\Services\ApiService;
use App\Services\FileUploadService;
use GuzzleHttp\Client;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ApiController extends Controller
{

    /**
     * @param Request $request
     * @return View|Application|Factory|JsonResponse|\Illuminate\Contracts\Foundation\Application
     */
    public function index(Request $request): View|Application|Factory|JsonResponse|\Illuminate\Contracts\Foundation\Application
    {
        $merchant = Merchant::approvedAndActivated()
            ->where('m_id', $request->session()->get('shop'))
            ->first();

        $request->session()->put(['data' => $request->only('order', 'amount', 'currency')]);

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
     * @param $id
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function pay(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $request->validate([
            'payment_system' => ['required'],
        ]);

        $data = (object)$request->session()->get('data');

        $paymentSystem = PaymentSystem::find($request->get('payment_system'));

        $payment = Payment::create([
            'm_id' => $request->session()->get('shop'),
            'amount' => $data->amount,
            'currency' => $data->currency,
            'order' => $data->order,
            'payment_system' => $paymentSystem->id,
        ]);


        $details = $paymentSystem->infos->reduce(function ($carry, $info) {
            if ($carry === null || $info->usage_count < $carry->usage_count) {
                return $info;
            }
            return $carry;
        }, null);

        $request->session()->put('details', $details);

        return view('api.pay', [
            'paymentSystem' => $paymentSystem,
            'details' => $details,
            'payment' => $payment,
        ]);
    }


    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function sendOrder(Request $request, $id): JsonResponse
    {
        try {
            $request->validate([
                'order' => ['required', 'image', 'mimes:jpeg,png,jpg,gif'],
            ]);

            $fileUpload = new FileUploadService($request->file('order'), 'orders');
            $fileUpload->upload();

            $payment = Payment::find($id);
            $payment->pay_screen = $fileUpload->getFileName();
            $payment->save();

            $details = $request->session()->get('details');
            $details->increment('usage_count');


            $transaction = Transaction::create([
                'm_id' => $payment->merchant->id,
                'user_id' => $payment->merchant->user_id,
                'amount' => $payment->amount,
                'currency' => $payment->currency,
                'type' => 'payIn',
                'payment_id' => $payment->id,
            ]);
            $request->session()->put('transaction', $transaction->id);
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 422);
        }

        return response()->json(['message' => 'Success'], 200);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function payConfirm(Request $request): JsonResponse
    {
        $transaction = Transaction::find($request->session()->get('transaction'));

        if ($transaction->payment->approved && $transaction->confirmed) {
            return response()->json(['message' => 'Success'], 200);
        }

        if ($transaction->payment->canceled && $transaction->canceled) {
            return response()->json(['message' => 'Cancel'], 200);
        }

        return response()->json(['message' => 'Waiting'], 200);
    }

    /**
     * @param Request $request
     * @param $action
     * @return RedirectResponse
     */
    public function redirect(Request $request, $action)
    {
        $transaction = Transaction::find($request->session()->get('transaction'));
//        $request->session()->flush();

        if ($action === 'approve') {
            $postData = ApiService::mappingResponseData($transaction);
            $postData['signature'] = ApiService::generateSignature($postData, $transaction->merchant->m_key);

            $postUrl = $transaction->merchant->handler_url;
            $postUrl = 'http://dev.it/handler.php';

            $client = new Client();

            $promise = $client->postAsync($postUrl, ['form_params' => $postData])->then(
                function ($response) use ($postUrl, $transaction) {
                    ClientResponse::create([
                        'transaction_id' => $transaction->id,
                        'data' => json_encode($response->getBody()->getContents()),
                    ]);
                    \Log::info("Успешный асинхронный запрос ({$postUrl}):  " . $response->getBody());
                },
                function ($exception) use ($postUrl, $transaction) {
                    ClientResponse::create([
                        'transaction_id' => $transaction->id,
                        'data' => json_encode($exception->getMessage()),
                    ]);
                    \Log::error("Ошибка при отправке асинхронного запроса ({$postUrl}): " . $exception->getMessage());
                }
            );
            $promise->wait();

            return redirect()->to($transaction->merchant->success_url);
        }
        return redirect()->to($transaction->merchant->fail_url);
    }


}
