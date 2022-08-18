<?php

namespace src\oop\app\src\Parsers;
use DiDom\Document;
use src\oop\app\src\Models\Movie;

class FilmixParserStrategy implements ParserInterface {

    public function parseContent(string $siteContent)
    {

        $document = new Document($siteContent);

        $images = $document->find('img');

        $h1 = $document->find('h1');
        preg_match('@(?:<h1 class="name" itemprop="name">)?([^<]+)@i', $h1[0], $matches);

        $about = $document->find('div[class=full-story]');

        $movie = new Movie();
        $movie->setTitle($matches[1]);
        $movie->setPoster($images[2]->src);
        $movie->setDescription($about[0]);
        return $movie;

    }
}
