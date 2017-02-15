<?php

namespace App\Crawler;

use Carbon\Carbon;
use Exception;
use predictionio\EngineClient;
use predictionio\EventClient;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;

/**
 * Class PageCrawler
 *
 * @package App\Crawler
 */
class PageCrawler
{
    /**
     * @const string URL
     */
    const URL = 'http://forum.bodybuilding.com/forumdisplay.php?f=19&page=';
    /**
     * @var \App\Crawler\Crawler
     */
    protected $crawler;

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
     * @param $page
     *
     * @return array
     */
    public function crawl($page)
    {
        $crawler = $this->crawler->get($this->getUrl($page));

        return $crawler->filter('.threadinfo-table tr')->each(function (DomCrawler $node) {

            $query = $node->filter('a.title')->attr('href');
            preg_match('/t=(\d+)&?/', $query, $matches);
            $url = $matches[1];

            $title = trim($node->filter('a.title')->text());

            $description = trim($node->filter('.threaddesc')->text());

            $rating = $node->filterXPath('//div[starts-with(@class, "rating")]')->attr('class');
            $rating = substr($rating, 6, -10);

            $meta = $node->filter('.threadmeta .author .label:not(a)')->text();
            // Replace &lrm chars with spaces and than trim
            list($author, $startDate) = array_map(function ($value) {
                return str_replace(['&lrm;', '-', '&nbsp;'], ['', '/', ' '], htmlentities($value));
            }, explode(',', $meta));

            $sticky = false;
            try {
                $node->filter('.nonsticky')->nodeName();
            } catch (Exception $e) {
                $sticky = true;
            }

            $lastPostDate = $node->filter('.forumlastpost dd:last-child')->text();
            $lastPostDate = trim(preg_filter(['/[\s,]+/', '/-/'], [' ', '/'], $lastPostDate));

            $lastPostAuthor = $node->filter('.forumlastpost .username')->text();

            $views = $node->filter('.td-views')->text();
            $replies = $node->filter('.td-reply')->text();

            $filtered = preg_filter(['/\s+/', '/,/'], ['', ''], [$views, $replies]);

            list($views, $replies) = $filtered;

            try {
                $pages = $node->filter('.pagination dd span:last-child a')->text();
            } catch (Exception $e) {
                $pages = 1;
            }
            $pages = preg_filter('/[\s+]?/', '', $pages);

            /*
             $accessKey = 'oONk84HsnfyYErjfPXBz5HZXkoWaL-l8Np4UWsTfIbB54LkXNMRJpSEN_32o5Cny';
            $client = new EngineClient('https://localhost:8000');
            $response = $client->sendQuery(array('s' => $title ));
            $titleSentiment = $response['sentiment'];
            $reponse = $client->sendQuery(array('s' => $description ));
            $descSentiment = $response['sentiment'];
            */

            return [
                'url'            => $url,
                'title'          => $title,
                'description'    => $description,
                'author'         => $author,
                'lastPostAuthor' => $lastPostAuthor,
                'startDate'      => new Carbon($startDate),
                'lastPostDate'   => new Carbon($lastPostDate),
                'rating'         => $rating,
                'sticky'         => $sticky,
                'views'          => $views,
                'replies'        => $replies,
                'pages'          => $pages,
                'created_at'     => Carbon::now(config('app.timezone')),
                'updated_at'     => Carbon::now(config('app.timezone')),
                'sentiment'      => 0,
                'indexed'        => false,
            ];
        });
    }

    /**
     * @param string $page
     *
     * @return string
     */
    private function getUrl($page)
    {
        $url = self::URL.$page;

        return $url;
    }
}
