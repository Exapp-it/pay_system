<?php

namespace App\Services;

use App\Models\PaymentSystem;
use App\Models\PSInfo;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PaymentSystemService
{
    /**
     * @param Request $request
     */
    public function __construct(public readonly Request $request)
    {
    }

    /**
     * @return $this
     */
    public function validate(): static
    {
        $this->request->validate([
            'title' => ['required', 'string'],
            'url' => ['required', 'url'],
            'desc' => ['required', 'string'],
            'logo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif'],
            'currency' => ['required'],
        ]);

        return $this;
    }

    /**
     * @return $this
     */
    public function validateInfo(): static
    {
        $this->request->validate([
            'ps_id' => ['required', 'exists:payment_systems,id'],
            'title' => ['required'],
            'value' => ['required'],
        ]);
        return $this;
    }


    /**
     * @return void
     */
    public function create(): void
    {
        $fileUpload = $this->getFileUpload();

        PaymentSystem::create([
            'title' => $this->request->post('title'),
            'desc' => $this->request->post('desc'),
            'url' => $this->request->post('url'),
            'logo' => $fileUpload->getFileName(),
            'currency' => $this->request->post('currency'),
        ]);
    }

    public function createInfo()
    {
        PSInfo::create([
            'ps_id' => intval($this->request->post('ps_id')),
            'title' => $this->request->post('title'),
            'value' => $this->request->post('value'),
        ]);
    }


    public function update(int $id): void
    {
        $paymentSystem = PaymentSystem::find($id);

        $data = [
            'title' => $this->request->post('title'),
            'url' => $this->request->post('url'),
            'desc' => $this->request->post('desc'),
            'logo' => $paymentSystem->logo,
        ];

        if ($this->request->hasFile('logo')) {
            $fileUpload = $this->getFileUpload();
            $data['logo'] = $fileUpload->getFileName();
        }

        if ($paymentSystem && $this->isDataDifferent($paymentSystem, $data)) {
            $paymentSystem->update($data);
        }
    }

    /**
     * @param $paymentSystem
     * @param $data
     * @return bool
     */
    private function isDataDifferent($paymentSystem, $data): bool
    {
        return ($paymentSystem->title != $data['title'] ||
            $paymentSystem->url != $data['url'] ||
            $paymentSystem->desc != $data['desc'] ||
            ($data['logo'] && $paymentSystem->logo != $data['logo']));
    }


    /**
     * @return \App\Services\FileUploadService
     */
    public function getFileUpload(): \App\Services\FileUploadService
    {
        $fileUpload = new FileUploadService($this->request->file('logo'), 'payment_systems');
        $fileUpload->upload();
        return $fileUpload;
    }
}
