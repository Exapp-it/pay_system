<?php

namespace App\Services;

use App\Models\ClientResponse;
use GuzzleHttp\Client;

class PaymentService
{

    public static function sendAsyncRequest($transaction): void
    {
        $postData = ApiService::mappingResponseData($transaction);
        $postData['signature'] = ApiService::generateSignature($postData, $transaction->merchant->m_key);

        $postUrl = $transaction->merchant->handler_url;

        $client = new Client();

        $promise = $client->postAsync($postUrl, ['form_params' => $postData])->then(
            function ($response) use ($postUrl, $transaction) {
                ClientResponse::updateOrCreate(
                    ['transaction_id' => $transaction->id],
                    ['data' => json_encode($response->getBody()->getContents())]
                );
                \Log::info("Успешный асинхронный запрос ({$postUrl}): " . $response->getBody());
            },
            function ($exception) use ($postUrl, $transaction) {
                ClientResponse::updateOrCreate(
                    ['transaction_id' => $transaction->id],
                    ['data' => json_encode($exception->getMessage())]
                );
                \Log::error("Ошибка при отправке асинхронного запроса ({$postUrl}): " . $exception->getMessage());
            }
        );

        $promise->wait();
    }

}
