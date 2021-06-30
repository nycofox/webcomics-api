<?php

namespace App\Scrapers;


use App\Models\Source;

class GenerateScraper extends WebcomicScraper
{

    /**
     * Converts the search string to a url with dates
     *
     * @param Source $source
     * @return string
     */
    public function getImageUrl(Source $source)
    {
        return $this->convertUrl($source->searchstring_comic);
    }
}
