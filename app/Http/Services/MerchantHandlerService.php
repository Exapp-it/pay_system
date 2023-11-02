<?php

namespace App\Http\Services;

use App\Models\Merchant;
use Illuminate\Http\Request;


class MerchantHandlerService
{

    protected ?Merchant $merchant = null;

    public function __construct(
        private readonly ?Request $request = null,
    )
    {
    }

    public function setMerchant(?Merchant $merchant): MerchantHandlerService
    {
        $this->merchant = $merchant;
        return $this;
    }

    public function validate(): void
    {
        $this->request->validate([
            'id' => 'required',
            'order' => 'required',
            'amount' => 'required',
            'currency' => 'required',
            'signature' => 'required',
            'handler' => 'required',
        ]);;
    }

    public function isProcess(): bool
    {
        return $this->request->post('handler') === 'process';
    }

    public function verifyHash(): bool
    {
        return $this->getHash($this->merchant) === $this->request->post('signature');
    }

    public function merchantExists(): bool
    {
        return (bool)$this->merchant;
    }


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



}
