<?php

declare(strict_types=1);

namespace DigipolisGent\API\Cache;

use Psr\SimpleCache\CacheInterface;

/**
 * Use this trait to add cache support to an object.
 */
trait CacheableTrait
{
    /**
     * The cache service.
     *
     * @var \Psr\SimpleCache\CacheInterface
     */
    protected $cache;

    /**
     * Set the cache service.
     *
     * @param \Psr\SimpleCache\CacheInterface $cache
     */
    public function setCacheService(CacheInterface $cache): void
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
     */
    protected function cacheSet(string $key, $value, $ttl = null): bool
    {
        if ($this->cache === null) {
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
     */
    protected function cacheDelete(string $key): bool
    {
        if ($this->cache === null) {
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
    protected function cacheClear(): bool
    {
        if ($this->cache === null) {
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
     */
    protected function cacheGet(string $key, $default = null)
    {
        if ($this->cache === null) {
            return null;
        }

        return $this->cache->get($key, $default);
    }
}
