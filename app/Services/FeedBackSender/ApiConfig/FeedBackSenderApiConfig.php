<?php

namespace App\Services\FeedBackSender\ApiConfig;

class FeedBackSenderApiConfig
{
    private $url;

    private $login;

    private $password;

    public function __construct()
    {
        $this->url = env('FEEDBACK_API_URL');
        $this->login = env('FEEDBACK_API_LOGIN');
        $this->password = env('FEEDBACK_API_PASSWORD');
    }

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getApiLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getApiPassword(): string
    {
        return $this->password;
    }
}
