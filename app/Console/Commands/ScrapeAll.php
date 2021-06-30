<?php

namespace App\Console\Commands;

use App\Models\Source;
use Illuminate\Console\Command;

class ScrapeAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webcomics:scrapeall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrapes all active webcomics';

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
     */
    public function handle()
    {
        $this->info('Scraping all webcomics starting at ' . now());

        $sources = Source::whereActive(true)->with('webcomic')->get();

        if ($sources->count() == 0) {
            $this->warn('No active sources found, aborting.');
            $this->line('--------------------------------------------------------');
            return null;
        }

        $this->info('Found ' . $sources->count() . ' sources, scraping...');

        foreach ($sources as $source) {
            $this->call('webcomics:scrape', ['source' => $source->id]);
        }

        $this->line('--------------------------------------------------------');
    }
}
