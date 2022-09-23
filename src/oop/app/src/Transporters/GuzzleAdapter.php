<?php

namespace src\oop\app\src\Transporters;

use GuzzleHttp\Client;

class GuzzleAdapter implements TransportInterface
{

    public function getContent(string $url): string
    {

        $client = new Client();
        $res = $client->request('GET', $url, [
            'auth' => ['user', 'pass']
        ]);
        $res->getStatusCode();
        $res->getHeader('content-type')[0];

        return $res->getBody();

    }
}

