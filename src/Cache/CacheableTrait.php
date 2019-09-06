<?php

namespace DigipolisGent\API\Cache;

use Psr\SimpleCache\CacheInterface;

/**
 * Class LoggableTrait.
 *
 * Use this trait to add cache to an object.
 *
 * @package DigipolisGent\API\Cache
 */
trait CacheableTrait
{
    /**
     * The cache service.
     *
     * @var CacheInterface
     */
    protected $cache;

    /**
     * Set the cache service.
     *
     * @param CacheInterface $cache
     */
    public function setCacheService(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Store a value in the cache service.
     *
     * This will check if a cache service is set.
     * If not: the item will not be cached.
     *
     * @param string $key
     *   The cache key to store the value in.
     * @param mixed $value
     *   The value to cache.
     * @param null|int|\DateInterval $ttl
     *   Optional. The TTL value of this item. If no value is sent and the
     *   driver supports TTL then the library may set a default value for it or
     *   let the driver take care of that.
     *
     * @return bool
     *   Item is cached.
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     *   If the $key string is not a legal value.
     */
    protected function cacheSet($key, $value, $ttl = null)
    {
        if (!$this->cache) {
            return false;
        }

        return $this->cache->set($key, $value, $ttl);
    }

    /**
     * Delete a value in the cache service.
     *
     * This will check if a cache service is set.
     * If not: return false.
     *
     * @param string $key
     *   The cache key to delete.
     *
     * @return bool
     *   Item is deleted.
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     *   If the $key string is not a legal value.
     */
    protected function cacheDelete($key)
    {
        if (!$this->cache) {
            return false;
        }

        return $this->cache->delete($key);
    }

    /**
     * Wipes clean the entire cache.
     *
     * @return bool
     *   Cache is cleared.
     */
    protected function cacheClear()
    {
        if (!$this->cache) {
            return false;
        }

        return $this->cache->clear();
    }

    /**
     * Retrieve a value from the cache service.
     *
     * This will check if a cache service is set.
     * If not: this will return a cache miss (null).
     *
     * @param string $key
     *   The cache key to store the value in.
     * @param mixed $default
     *   The default value if the item is not cached.
     *
     * @return mixed
     *   Cached value or default if no cache for the item.
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     *   If the $key string is not a legal value.
     */
    protected function cacheGet($key, $default = null)
    {
        if (!$this->cache) {
            return null;
        }

        return $this->cache->get($key, $default);
    }
}
