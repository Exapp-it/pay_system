<?php

namespace App\Services;

use App\Models\Merchant;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;


class ApiService
{

    /**
     * @var Merchant|null
     */
    protected ?Merchant $merchant = null;


    public function __construct(private readonly ?Request $request, ?Merchant $merchant = null)
    {
        $this->merchant = $merchant;
    }


    /**
     * @return void
     */
    public function validate(): void
    {
        $this->request->validate([
            'shop' => ['required'],
            'order' => ['required'],
            'amount' => ['required', 'numeric'],
            'currency' => ['required'],
            'signature' => ['required'],
        ]);;
    }


    /**
     * @return bool
     */
    public function verifyHash(): bool
    {
        return $this->getHash($this->merchant) === $this->request->post('signature');
    }

    /**
     * @return bool
     */
    public function merchantExists(): bool
    {
        return (bool)$this->merchant;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->request->only(['shop', 'order', 'amount', 'currency']);
    }

    /**
     * @return string
     */
    protected function getHash(): string
    {
        $data = [
            $this->merchant->m_id,
            $this->request->post('order'),
            $this->request->post('amount'),
            $this->request->post('currency'),
            $this->merchant->m_key,
        ];

        $hashString = implode(':', $data);
        $hashedValue = hash('sha256', $hashString);

        return strtoupper($hashedValue);
    }

    /**
     * @return mixed
     */
    public function createPayment(): mixed
    {
        return Payment::create([
            'm_id' => $this->merchant->m_id,
            'amount' => $this->request->post('amount'),
            'currency' => $this->request->post('currency'),
            'order' => $this->request->post('order'),
            'payment_system' => 'p2p',
        ]);
    }

    /**
     * @param $payment
     * @return mixed
     */
    public function addTransaction($payment): mixed
    {
        return Transaction::create([
            'p_id' => $payment->id,
            'amount' => $payment->amount,
            'currency' => $payment->currency,
        ]);
    }

    /**
     * @param Transaction $transaction
     * @return array
     */
    public function transactionMapping(Transaction $transaction): array
    {
        $payment = $transaction->payment()->first();

        return [
            'status' => 'success',
            'message' => 'ok',
            'data' => [
                'operation_id' => $transaction->id,
                'operation_pay_system' => $payment->payment_system,
                'operation_date' => $transaction->created_at->format('Y-m-d H:i:s'),
                'operation_pay_date' => $transaction->updated_at->format('Y-m-d H:i:s'),
                'shop' => $payment->m_id,
                'amount' => $transaction->amount,
                'order' => $payment->order,
                'currency' => $transaction->currency,
            ],
        ];
    }


}
