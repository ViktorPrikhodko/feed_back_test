<?php

namespace App\Services\FeedBackSender\ApiClient;

use App\Models\FeedBackMessage;
use App\Services\Exceptions\FeedBackSenderException;
use App\Services\FeedBackSender\ApiConfig\FeedBackSenderApiConfig;
use App\Services\FeedBackSender\HttpFakeClient;
use Illuminate\Support\Facades\Log;
use JsonException;

class FeedBackSenderApiClient
{
    private $apiConfig;

    private $client;

    public function __construct(HttpFakeClient $client, FeedBackSenderApiConfig $apiConfig)
    {
        $this->client = $client;
        $this->apiConfig = $apiConfig;
    }

    /**
     * Отправка сообщения на сторонний Api
     * @param FeedBackMessage $feedBackMessage
     * @return bool
     */
    public function sendMessage(FeedBackMessage $feedBackMessage): bool
    {
        try {
            $response = $this->client->request('POST', $this->apiConfig->getApiUrl(), [
                'body' => $this->getFeedBackRequestBody($feedBackMessage),
                'header' => [
                    'Content-Type' => 'application/json',
                    'Login' => $this->apiConfig->getApiLogin(),
                    'Password' => $this->apiConfig->getApiPassword()
                ]
            ]);

            $result = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);

            Log::channel('feedBackSender')
                ->info('Отправка feedback к внешней Api', [
                    'time' => now()->format('H:m:i'),
                    'apiUrl' => $this->apiConfig->getApiUrl(),
                    'apiLogin' => $this->apiConfig->getApiLogin(),
                    'apiPwd' => $this->apiConfig->getApiPassword(),
                    'apiResult' => $result['result'],
                    'userMail' => $feedBackMessage->email,
                    'feedBackMessage' => $feedBackMessage->message
                ]);

            return (bool)$result['result'];

        } catch (FeedBackSenderException|JsonException $e) {
            Log::channel('feedBackSender')
                ->error('Отправка feedback к внешней Api', [
                    'time' => now()->format('H:m:i'),
                    'errorMessage' => $e->getMessage(),
                    'userMail' => $feedBackMessage->email
                ]);
        }

        return false;
    }

    /**
     * Формирования body запроса
     * @param FeedBackMessage $feedBackMessage
     * @return string
     * @throws FeedBackSenderException
     */
    private function getFeedBackRequestBody(FeedBackMessage $feedBackMessage): string
    {
        try {
            return json_encode([
                'email' => $feedBackMessage->email,
                'message' => $feedBackMessage->message,
            ], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            throw new FeedBackSenderException(
                'Ошибка кодировки в json строку. ' . $exception->getMessage()
            );
        }
    }
}
