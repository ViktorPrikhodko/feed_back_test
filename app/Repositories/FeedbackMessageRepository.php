<?php

namespace App\Repositories;

use App\Exceptions\FeedBackException;
use App\Jobs\SendFeedBackMessageJob;
use App\Models\FeedBackMessage;

class FeedbackMessageRepository extends BaseRepository
{
    protected $model = FeedBackMessage::class;

    /**
     * Получение feedback-сообщения по ID
     *
     * @param int $id
     * @return FeedBackMessage
     * @throws FeedBackException
     */
    public function getById(int $id): FeedBackMessage
    {
        $model = FeedBackMessage::find($id);

        if (!$model) {
            throw new FeedBackException("Сообщение с ID {$id} не найдено", 404);
        }

        return $model;
    }

    /**
     * Создание записи в таблице о feedback-сообщении и отправка
     * его в FeedBackSenderService
     * @param array $data
     * @return bool
     */
    public function sendFeedBackMessage(array $data): bool
    {
        $model = FeedBackMessage::query()->create($data);

        if (!$model) {
            return false;
        }

        SendFeedBackMessageJob::dispatch($model);

        return true;
    }

    /**
     * Обновляет Модель feedback-сообщения
     * @param int $modelId
     * @param array $data
     * @return void
     * @throws FeedBackException
     */
    public function update(int $modelId, array $data): void
    {
        $model = $this->getById($modelId);

        $model->update($data);
    }
}
