<?php

namespace App\Services\FeedBackSender;

class HttpFakerResponse
{
    private $code;

    private $body;

    /**
     * @param int $code
     * @param string $body
     */
    public function __construct(int $code, string $body)
    {
        $this->code = $code;
        $this->body = $body;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }
}
