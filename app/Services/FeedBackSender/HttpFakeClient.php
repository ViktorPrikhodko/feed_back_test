<?php

namespace App\Services\FeedBackSender;

class HttpFakeClient
{
    /**
     * @param string $method
     * @param string $url
     * @param array $options
     * @return HttpFakerResponse
     */
    public function request(string $method, string $url, array $options = []): HttpFakerResponse
    {
        sleep(2);

        return new HttpFakerResponse(200, '
            {
                "result" : true
            }
        ');
    }
}
