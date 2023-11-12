<?php

namespace App\Services;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class MerchantService
{

    /**
     * @param Request|null $request
     */
    public function __construct(public readonly ?Request $request = null)
    {
    }

    /**
     * @return $this
     */
    public function validate(): static
    {
        $this->request->validate([
            'title' => ['required', 'string'],
            'base_url' => ['required', 'string', 'unique:merchants,base_url', 'url:https'],
            'success_url' => [
                'required',
                'string',
                'url:https',
                function ($attribute, $value, $fail) {
                    $baseUrl = request('base_url');
                    if (strpos($value, $baseUrl) !== 0) {
                        $fail('success_url должен начинаться с base_url');
                    }
                },
            ],
            'fail_url' => [
                'required',
                'string',
                'url:https',
                function ($attribute, $value, $fail) {
                    $baseUrl = request('base_url');
                    if (strpos($value, $baseUrl) !== 0) {
                        $fail('fail_url должен начинаться с base_url');
                    }
                },
            ],
            'handler_url' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $baseUrl = request('base_url');
                    if (strpos($value, $baseUrl) !== 0) {
                        $fail('handler_url должен начинаться с base_url');
                    }
                },
            ],
        ]);

        return $this;
    }

    /**
     * @return mixed
     */
    public function create(): mixed
    {
        return Merchant::create([
            'user_id' => $this->request->user()->id,
            'm_id' => $this->generateId(9),
            'm_key' => $this->generateKey(),
            'title' => $this->request->input('title'),
            'base_url' => $this->request->post('base_url'),
            'success_url' => $this->request->post('success_url'),
            'fail_url' => $this->request->post('fail_url'),
            'handler_url' => $this->request->post('handler_url'),
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
            $this->request->post('order'),
            $this->request->post('amount'),
            $this->request->post('currency'),
            $merchant->m_key,
        ];

        $hashString = implode(':', $data);
        $hashedValue = hash('sha256', $hashString);

        return strtoupper($hashedValue);
    }


    /**
     * @param int $length
     * @return int
     */
    protected function generateId(int $length = 12): int
    {
        $baseValue = time() * 1000;
        $randomDigits = mt_rand(1000, 9999);

        $baseValueString = strval($baseValue);
        $shuffledBaseValueString = str_shuffle($baseValueString);

        $uniqueId = substr(intval($shuffledBaseValueString) + $randomDigits, 0, $length);

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
