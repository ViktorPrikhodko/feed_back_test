<?php

namespace App\Services\FeedBackSender;

use App\Exceptions\FeedBackException;
use App\Models\FeedBackMessage;
use App\Repositories\FeedbackMessageRepository;
use App\Services\FeedBackSender\ApiClient\FeedBackSenderApiClient;

class FeedBackSenderService
{
    private $apiClient;

    /**
     * @param FeedBackSenderApiClient $client
     */
    public function __construct(FeedBackSenderApiClient $client)
    {
        $this->apiClient = $client;
    }

    /**
     * Отправляет feedback сообщение через внешний Api
     * @param FeedBackMessage $feedBackMessage
     * @return void
     */
    public function sendFeedBackMessage(FeedBackMessage $feedBackMessage): void
    {
        $this->apiClient->sendMessage($feedBackMessage);
    }
}
