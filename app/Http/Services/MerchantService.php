<?php

namespace App\Http\Services;

use App\Models\Merchant;
use Illuminate\Http\Request;


class MerchantService
{

    public function __construct(private readonly ?Request $request = null)
    {
    }

    public function validate(): static
    {
        $this->request->validate([
            'title' => 'required', 'string',
            'base_url' => 'required', 'string',
            'success_url' => 'required', 'string',
            'fail_url' => 'required', 'string',
            'handler_url' => 'required', 'string',
        ]);;

        return $this;
    }

    public function create()
    {
        return Merchant::create([
            'user_id' => $this->request->user()->id,
            'm_id' => $this->generateId(),
            'm_key' => $this->generateKey(),
            'title' => $this->request->input('title'),
            'base_url' => $this->request->input('base_url'),
            'success_url' => $this->request->input('success_url'),
            'fail_url' => $this->request->input('fail_url'),
            'handler_url' => $this->request->input('handler_url'),
        ]);
    }

    public function getHash(Merchant $merchant): string
    {
        $data = [
            $merchant->m_id,
            $this->request->input('order'),
            $this->request->input('amount'),
            $this->request->input('currency'),
            $merchant->m_key,
        ];

        $hashString = implode(':', $data);
        $hashedValue = hash('sha256', $hashString);

        return strtoupper($hashedValue);
    }

    protected function generateId(): int
    {
        $baseValue = time() * 1000;
        $randomDigits = mt_rand(1000, 9999);

        $baseValueString = strval($baseValue);
        $shuffledBaseValueString = str_shuffle($baseValueString);

        $uniqueId = substr(intval($shuffledBaseValueString) + $randomDigits, 0, 12);

        return (int)$uniqueId;
    }


    protected function generateKey(): string
    {
        $characters = '0123456789#&%?:.abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $key = '';

        for ($i = 0; $i < 32; $i++) {
            $key .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $key;
    }
}
