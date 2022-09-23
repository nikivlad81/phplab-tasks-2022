<?php

namespace src\oop\app\src\Parsers;

use src\oop\app\src\Models\Movie;
use Symfony\Component\DomCrawler\Crawler;

class KinoukrDomCrawlerParserAdapter implements ParserInterface
{

    public function parseContent(string $siteContent)
    {
        $crawler = new Crawler($siteContent);

        $dataArray = $crawler->filter('div.wrap')->each(function ($node) {
            $nodeItems = $node->filter('div.items');
            $title = $nodeItems->filter('div.ftitle')->text();
            $poster = $nodeItems->filter('div.fposter > a')->attr('href');
            $description = $nodeItems->filter('div.fdesc')->text();
            $movie = new Movie();
            $movie->setTitle($title);
            $movie->setPoster($poster);
            $movie->setDescription($description);
            return $movie;
        });

        return reset($dataArray);

    }
}
