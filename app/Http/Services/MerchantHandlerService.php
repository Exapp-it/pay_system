<?php

namespace App\Http\Services;

use App\Models\Merchant;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;


class MerchantHandlerService
{

    /**
     * @var Merchant|null
     */
    protected ?Merchant $merchant = null;

    /**
     * @param Request|null $request
     */
    public function __construct(
        private readonly ?Request $request = null,
    )
    {
    }

    /**
     * @param Merchant|null $merchant
     * @return $this
     */
    public function setMerchant(?Merchant $merchant): MerchantHandlerService
    {
        $this->merchant = $merchant;
        return $this;
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
            'handler' => ['required'],
        ]);;
    }

    /**
     * @return bool
     */
    public function isProcess(): bool
    {
        return $this->request->post('handler') === 'process';
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
     * @return string
     */
    protected function getHash(): string
    {
        $data = [
            $this->merchant->m_id,
            $this->request->input('order'),
            $this->request->input('amount'),
            $this->request->input('currency'),
            $this->merchant->m_key,
        ];

        $hashString = implode(':', $data);
        $hashedValue = hash('sha256', $hashString);

        return strtoupper($hashedValue);
    }

    /**
     * @return mixed
     */
    public function createPayment()
    {
        return Payment::create([
            'm_id' => $this->merchant->m_id,
            'amount' => $this->request->post('amount'),
            'payment_system' => 'p2p',
            'currency' => $this->request->post('currency'),
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


}
