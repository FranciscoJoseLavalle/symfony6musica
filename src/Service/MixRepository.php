<?php

namespace App\Service;

use Psr\Cache\CacheItemInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\Cache\CacheInterface;

class MixRepository
{

    private $httpClient;
    private $cache;

    public function __construct(CacheInterface $cache, HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->cache = $cache;
    }

    public function findAll() {
        return $this->cache->get('mixes-data', function(CacheItemInterface $cacheItem) {
            $cacheItem->expiresAfter(5);
            $response = $this->httpClient->request('GET', "https://raw.githubusercontent.com/SymfonyCasts/vinyl-mixes/main/mixes.json");

            return $response->toArray();
        });
    }
}
