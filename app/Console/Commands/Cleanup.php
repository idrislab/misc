<?php

namespace App\Console\Commands;

use App\Crawler\ThreadCrawler;
use App\Status;
use App\Thread;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Cleanup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleanup indexed misc thread';

    /**
     * Create a new command instance.
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
        $date = Carbon::now()->subDays(2);
        Thread::where('startDate', '<', $date)
            ->where('posts', '<', 60)
            ->delete();
    }
}
