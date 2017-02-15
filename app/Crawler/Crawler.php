<?php

namespace App\Crawler;

use Goutte\Client;
use GuzzleHttp\HandlerStack;
use Illuminate\Support\Facades\Cache;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\LaravelCacheStorage;
use Kevinrob\GuzzleCache\Strategy\PrivateCacheStrategy;

/**
 * Class Crawler
 *
 * @package App\Crawler
 */
class Crawler
{
    /**
     * @var \Goutte\Client
     */
    protected $client;

    /**
     * Create a new client instance.
     *
     * @param \Goutte\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;

        $stack = HandlerStack::create();

        $stack->push(
            new CacheMiddleware(
                new PrivateCacheStrategy(
                    new LaravelCacheStorage(
                        Cache::store('file')
                    )
                )
            ),
            'cache'
        );

        $guzzleClient = new \GuzzleHttp\Client([
            'handler'        => $stack,
            'timeout'        => 60,
            'decode_content' => 'gzip',
            'User-Agent'     => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) '.
                                'Chrome/40.0.2214.85 Safari/537.36',
        ]);

        $this->client->setClient($guzzleClient);
    }

    /**
     * @param $url
     *
     * @return \Symfony\Component\DomCrawler\Crawler
     */
    public function get($url)
    {
        return $this->client->request('GET', $url);
    }

    /**
     * @return \Goutte\Client
     */
    public function getClient()
    {
        return $this->client;
    }
}
