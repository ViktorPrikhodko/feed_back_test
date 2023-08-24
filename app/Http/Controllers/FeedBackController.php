<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedBackRequest;
use App\Repositories\FeedbackMessageRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FeedBackController extends Controller
{
    private $feedBackMessageRepository;

    /**
     * @param FeedbackMessageRepository $feedBackMessageRepository
     */
    public function __construct(FeedbackMessageRepository $feedBackMessageRepository)
    {
        $this->feedBackMessageRepository = $feedBackMessageRepository;
    }

    public function showFrom()
    {
        return view('feedback_form');
    }

    /**
     * @param FeedBackRequest $contactRequest
     * @return RedirectResponse
     */
    public function sendFeedback(FeedBackRequest $contactRequest): RedirectResponse
    {
        $sendResult = $this->feedBackMessageRepository->sendFeedBackMessage($contactRequest->input());
        $redirect = redirect()->back();

        if (!$sendResult) {
            return $redirect->with('error', 'Не удалось отправить ваш отзыв');
        }

        return $redirect->with('success', 'Спасибо за ваш отзыв!');
    }
}
