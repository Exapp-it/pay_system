<?php

namespace App\Services;

use App\Models\Merchant;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;


class ApiService
{

    public function __construct(
        public readonly Request  $request,
        public readonly Merchant $merchant)
    {
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
			'username' => ['required'],
            'currency' => ['required'],
            'signature' => ['required'],
        ]);;
    }


    /**
     * @return bool
     */
    public function verifyHash(): bool
    {
        return $this->getHash($this->merchant) === $this->request->post('signature') || $this->request->get('signature');
    }

    /**
     * @return bool
     */
    public function merchantExists(): bool
    {
        return (bool)$this->merchant;
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
     * @param Transaction $transaction
     * @return array
     */
    public static function mappingResponseData(Transaction $transaction): array
    {
        $payment = $transaction->payment()->first();

        return [
            'status' => 'success',
            'operation_id' => $transaction->id,
            'operation_pay_system' => $payment->payment_system,
            'operation_date' => $transaction->created_at->format('Y-m-d H:i:s'),
            'operation_pay_date' => $transaction->updated_at->format('Y-m-d H:i:s'),
            'shop' => $payment->m_id,
            'order' => $payment->order,
            'amount' => $transaction->amount,
            'amount_azn' => $payment->amount_default_currency,
            'currency' => $transaction->currency,
            'shop_key' => $payment->merchant->m_key,
        ];
    }

    /**
     * @param $data
     * @return string
     */
    public static function generateSignature($data): string
    {
        $hashString = implode(':', $data);
        $hashedValue = hash('sha256', $hashString);

        return strtoupper($hashedValue);
    }
}
