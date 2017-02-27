<?php

namespace App\Console\Commands;

use App\Crawler\ThreadCrawler;
use App\Status;
use App\Thread;
use Carbon\Carbon;
use Illuminate\Console\Command;

class indexThreads extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'index:threads';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl misc thread';
    /**
     * @var \App\Crawler\ThreadCrawler
     */
    protected $crawler;

    /**
     * Create a new command instance.
     *
     * @param ThreadCrawler $crawler
     */
    public function __construct(ThreadCrawler $crawler)
    {
        parent::__construct();

        $this->crawler = $crawler;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $threads = Thread::where('indexed', 0)
            ->where('sticky', false)
            ->orderBy('startDate', 'desc')
            ->get();

        $bar = $this->output->createProgressBar($threads->count());

        foreach ($threads as $thread) {
            $posts = $this->crawler->crawl($thread->url);

            $ups = 1;
            $downs = 1;
            $hotness = 0;
            $months = 15778463;

            if (empty($posts)) {
                continue;
            }

            foreach ($posts as $post) {
                $userPosts = $post['posts'];
                $postDate = $post['postDate']->timestamp;
                $joinDate = $post['joinDate']->timestamp;
                $repPower = $post['repPower'] * 1 + 1;

                //$ups += (($posts/$joinDate) + $posts + $postDate + ($repPower/$posts));
                $ups += ($userPosts + ($repPower + 1)) / ($months / ($joinDate+1)) + $postDate + (($repPower+1) / ($userPosts+1));
            }

            $postsConfidence = $this->confidence($ups, $downs);
            $hotness += $this->hot($ups, $downs, (new Carbon($thread->lastPostDate))->timestamp);
            $hotness += $this->hot($ups, $downs, (new Carbon($thread->startDate))->timestamp);

            $rating = (int) $thread->rating;
            $replies = (int) $thread->replies;
            $views = (int) $thread->views;

            $ups = ($rating * ($replies + 1) / ($views + 1)) + $replies + $views;

            $confidence = $postsConfidence + $this->confidence($ups, $downs);
            $hotness += $this->hot($ups, $downs, (new Carbon($thread->startDate))->timestamp);

            $avatar = $posts[0]['avatar'];
            $description = $posts[0]['post'];

            Thread::where('id', $thread->id)
                ->update([
                    'description' => $description,
                    'confidence' => $confidence,
                    'hotness' => $hotness,
                    'posts' => count($posts) + 1,
                    'avatar' => $avatar,
                    'indexed' => true,
                    'indexDate' => (new Carbon())->now(),
                ]);

            $bar->advance();
        }

        $bar->finish();

        Status::insertOnDuplicateKey([
            'id' => 1,
            'updated_at' => (new Carbon())->now(),
        ]);
    }

    /**
     * @param $ups
     * @param $downs
     * @return mixed
     */
    protected function score($ups, $downs)
    {
        return ($ups - $downs);
    }

    /**
     * @param $ups
     * @param $downs
     * @param $date
     * @return float
     */
    protected function hot($ups, $downs, $date)
    {
        $s = $this->score($ups, $downs);

        $order = log10(max(abs($s), 1));

        if ($s > 0) {
            $sign = 1;
        } else {
            if ($s < 0) {
                $sign = -1;
            } else {
                $sign = 0;
            }
        }

        $seconds = $date - 1134028003;

        return round($order + $sign * $seconds / 45000, 7);
    }

    /**
     * @param $ups
     * @param $downs
     * @return float|int
     */
    protected function controversy($ups, $downs)
    {
        return floatval($ups + $downs) / max(abs($this->score($ups, $downs)), 1);
    }

    /**
     * @param $ups
     * @param $downs
     * @return float|int
     */
    protected function confidence($ups, $downs)
    {
        $n = $ups + $downs;

        if ($n == 0) {
            return 0;
        }

        $z = 1.281551565545;
        $p = floatval($ups) / $n;

        $left = $p + 1 / (2 * $n) * $z * $z;
        $right = $z * sqrt($p * (1 - $p) / $n + $z * $z / (4 * $n * $n));
        $under = 1 + 1 / $n * $z * $z;

        return ($left - $right) / $under;
    }
}
