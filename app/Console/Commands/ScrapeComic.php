<?php

namespace App\Console\Commands;

use App\Models\Source;
use Illuminate\Console\Command;

class ScrapeComic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webcomics:scrape {source}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape a specified comic source';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $source = Source::findOrFail($this->argument('source'));

        $this->info($source->webcomic->name . ' - Processing source ' . $source->homepage);

        if(!class_exists($source->scraper)) {
            $this->error('  Scraper ' . $source->scraper . ' does not exist, skipping...');
            return null;
        }

        $scraper = new $source->scraper($source);

        if (!$imageurl = $scraper->getImageUrl($source)) {
            $this->warn('Could not find any strip, skipping...');
            return null;
        }

        $this->line('  Found image at url: ' . $imageurl);

        if (!$image = $scraper->downloadImage($imageurl, $source)) {
            $this->warn('  Failed downloading image with url ' . $imageurl . ' , skipping...');
            return null;
        }

        $this->line('  Downloaded image, checking for duplicates...');

        if($scraper->checkDuplicate(md5($image)))
        {
            $this->warn('  Comic already downloaded, skipping...');
            return null;
        }

        $this->line('  No duplicate found, storing image...');

        if (!$media = $scraper->storeImage($image, $source)) {
            $this->warn('Could not store image, skipping...');

            // Todo: should downloaded image be deleted?

            return null;
        }

        $this->info('  Successfully downloaded and stored image with strip id ' . $media->id);
    }
}
