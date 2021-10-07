<?php


namespace App\Modules\WebsiteData\Storages;

use App\Modules\WebsiteData\Providers\WebsiteDataProvider;
use App\Modules\WebsiteData\WebsiteData;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Cache\CacheManager;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Collection;

class RedisWebsiteDataStorage implements WebsiteDataStorage
{
    const CACHE_KEY = 'website_data';

    /**
     * @var Repository
     */
    protected Repository $cache;

    /**
     * @var WebsiteDataProvider
     */
    protected WebsiteDataProvider $dataProvider;

    /**
     * RedisWebsiteDataStorage constructor.
     * @param CacheManager $cache
     * @param WebsiteDataProvider $dataProvider
     */
    public function __construct(CacheManager $cache, WebsiteDataProvider $dataProvider)
    {
        $this->cache = $cache->store('redis');
        $this->dataProvider = $dataProvider;
    }

    /**
     * Check if data have already been stored and return it.
     * And in case if we do not have it, make a new api call and store response to the redis.
     * @return Collection
     */
    public function get(): Collection
    {
        return $this->cache->rememberForever(self::CACHE_KEY, function () {
            return $this->dataProvider->data();
        });
    }

    /**
     * Call an api provider and store response to the redis.
     *
     * @return bool
     * @throws GuzzleException
     */
    public function update(): bool
    {
        return $this->cache->forever(
            self::CACHE_KEY,
            $this->dataProvider->data()
        );
    }
}
