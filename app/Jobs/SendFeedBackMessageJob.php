<?php

namespace App\Jobs;

use App\Models\FeedBackMessage;
use App\Services\FeedBackSender\FeedBackSenderService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendFeedBackMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $feedBackMessage;

    /**
     * Create a new job instance.
     * @param FeedBackMessage $feedBackMessage
     * @return void
     */
    public function __construct(FeedBackMessage $feedBackMessage)
    {
        $this->feedBackMessage = $feedBackMessage;
    }

    /**
     * Execute the job.
     *
     * @param FeedBackSenderService $feedBackSenderService
     * @return void
     */
    public function handle(FeedBackSenderService $feedBackSenderService): void
    {
        $feedBackSenderService->sendFeedBackMessage($this->feedBackMessage);
    }
}
