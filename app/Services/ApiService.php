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


}
