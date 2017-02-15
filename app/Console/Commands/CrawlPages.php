<?php

namespace App\Console\Commands;

use App\Crawler\PageCrawler;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Thread;
use Illuminate\Support\Facades\Cache;

class CrawlPages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:pages {pages=10}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl Pages';
    /**
     * @var \App\Console\Commands\Crawler
     */
    protected $crawler;

    /**
     * Create a new command instance.
     *
     * @param \App\Crawler\PageCrawler $crawler
     */
    public function __construct(PageCrawler $crawler)
    {
        parent::__construct();

        $this->crawler = $crawler;
    }

    /**
     * Execute the console command.
     *
     * @internal param \App\Thread $thread
     */
    public function handle()
    {
        $pages = $this->argument('pages');

        $bar = $this->output->createProgressBar($pages);

        $list = [];

        for ($page = 1; $page <= $pages; $page++) {
            $bar->advance();

            $threads = $this->crawler->crawl($page);

            foreach ($threads as $thread) {
                $list[] = $thread;
            }
        }

        Thread::store($list);

        $bar->finish();
    }
}
