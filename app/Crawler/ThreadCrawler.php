<?php

namespace App\Crawler;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;

/**
 * Class ThreadCrawler
 *
 * @package App\Crawler
 */
class ThreadCrawler
{
    /**
     * @var \App\Crawler\Crawler
     */
    protected $crawler;
    /**
     * @var int
     */
    protected $pages = 4;

    /**
     * Create a new crawler instance.
     *
     * @param \App\Crawler\Crawler $crawler
     */
    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }

    /**
     * @param int $thread
     * @return array
     */
    public function crawl($thread)
    {
        $posts = [];

        for ($page = 1; $page <= $this->pages; $page++) {
            $crawler = $this->crawler->get($this->getUrl($thread, $page));

            if ($page === 1) {
                if ($crawler->filter('#pagination_top a.popupctrl')->count()) {
                    $pages = strtolower($crawler->filter('#pagination_top a.popupctrl')->text());
                    $pages = substr($pages, strpos($pages, 'of ') + strlen('of '));
                    $this->pages = ((int)$pages >= $this->pages) ? $this->pages : (int)$pages;
                } else {
                    $this->pages = 1;
                }
            }

            if (!$crawler->filterXpath('//li[contains(@id,\'post_\')]')->count()) {
                //thread was deleted
                continue;
            }

            $data = $crawler->filterXpath('//li[contains(@id,\'post_\')]')->each(function (DomCrawler $node) {
                try {
                    $postDate = $node->filter('.date')->text();
                    $postDate = trim(preg_filter(['/[\s,]+/', '/-/'], [' ', '/'], $postDate));

                    $joinDate = $node->filterXpath('//div[@class="userinfo"]//dl/dt[contains(text(),\'Join Date:\')]')->text();
                    $joinDate = trim(str_replace('Join Date:', '', $joinDate));

                    $posts = $node->filterXpath('//div[@class="userinfo"]//dl/dt[contains(text(),\'Posts:\')]')->text();
                    $posts = trim(preg_replace(['/,/', '/Posts\:/'], ['', ''], $posts));

                    $repPower = $node->filterXpath('//div[@class="userinfo"]//dl/dt[contains(text(),\'Rep Power:\')]')->text();
                    $repPower = trim(str_replace('Rep Power:', '', $repPower));

                    $post = $node->filter('.postcontent')->html();

                    $avatar = $node->filter('.postuseravatar img')->attr('src');

                    return [
                        'postDate' => new Carbon($postDate),
                        'joinDate' => new Carbon($joinDate),
                        'posts' => $posts,
                        'repPower' => $repPower,
                        'avatar' => $avatar,
                        'post' => $post,
                    ];

                } catch (\Exception $e) {
                    Log::warning($e->getMessage());
                    return;
                }
            });

            $posts = array_merge($posts, $data);
        }

        return $posts;
    }

    /**
     * @param int $thread
     * @param int $page
     * @return string
     */
    private function getUrl($thread, $page = 1)
    {
        return 'http://forum.bodybuilding.com/showthread.php?t=' . $thread . '&page=' . $page;
    }
}
