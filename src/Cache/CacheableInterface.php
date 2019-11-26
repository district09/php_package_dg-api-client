<?php

declare(strict_types=1);

namespace DigipolisGent\API\Cache;

use Psr\SimpleCache\CacheInterface;

/**
 * Interface to add cache to a service.
 */
interface CacheableInterface
{
    /**
     * Set the cache service.
     *
     * @param \Psr\SimpleCache\CacheInterface $cache
     */
    public function setCacheService(CacheInterface $cache): void;
}
