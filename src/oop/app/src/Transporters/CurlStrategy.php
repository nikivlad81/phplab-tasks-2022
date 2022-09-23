<?php

namespace src\oop\app\src\Transporters;

class CurlStrategy implements TransportInterface
{

    public function getContent(string $url): string
    {
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);

        $siteContent = curl_exec($curl);
        $siteContent = iconv('CP1251', mb_detect_encoding($siteContent), $siteContent);
        curl_close($curl);

        return $siteContent;

    }
}
