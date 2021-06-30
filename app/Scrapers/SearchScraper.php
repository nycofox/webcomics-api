<?php


namespace App\Scrapers;


use App\Models\Source;
use Illuminate\Support\Facades\Http;

class SearchScraper extends WebcomicScraper
{

    public function getImageUrl(Source $source)
    {
        $url = $source->searchpage ?? $source->homepage;

        $searchpage = Http::get($this->convertUrl($url));

        if($searchpage->failed()) {
            return null;
        }

        $searchstring = '/' . $this->convertUrl($source->searchstring_comic) . '/';

        if(preg_match_all($searchstring, $searchpage->body(), $result)) {
            return $result[1][0];
        }

        return null;
    }
}
