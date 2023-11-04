<?php

namespace App\Services;

use App\Models\Merchant;
use Illuminate\Http\Request;


class MerchantService
{

    /**
     * @param Request|null $request
     */
    public function __construct(private readonly ?Request $request = null)
    {
    }

    /**
     * @return $this
     */
    public function validate(): static
    {
        $this->request->validate([
            'title' => ['required', 'string'],
            'base_url' => ['required', 'string', 'unique:merchants,base_url'],
            'success_url' => ['required', 'string'],
            'fail_url' => ['required', 'string'],
            'handler_url' => ['required', 'string'],
        ]);;

        return $this;
    }

    /**
     * @return mixed
     */
    public function create(): mixed
    {
        $baseUrl = rtrim($this->request->input('base_url'), '/');
        $successUrl = $baseUrl . '/' . $this->request->input('success_url');
        $failUrl = $baseUrl . '/' . $this->request->input('fail_url');
        $handlerUrl = $baseUrl . '/' . $this->request->input('handler_url');

        return Merchant::create([
            'user_id' => $this->request->user()->id,
            'm_id' => $this->generateId(9),
            'm_key' => $this->generateKey(),
            'title' => $this->request->input('title'),
            'base_url' => $baseUrl,
            'success_url' => $successUrl,
            'fail_url' => $failUrl,
            'handler_url' => $handlerUrl,
        ]);
    }

    /**
     * @param Merchant $merchant
     * @return string
     */
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

    /**
     * @return int
     */
    protected function generateId(int $length = 12): int
    {
        $baseValue = time() * 1000;
        $randomDigits = mt_rand(1000, 9999);

        $baseValueString = strval($baseValue);
        $shuffledBaseValueString = str_shuffle($baseValueString);

        $uniqueId = substr(intval($shuffledBaseValueString) + $randomDigits, 0,  $length);

        return (int)$uniqueId;
    }


    /**
     * @return string
     */
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
