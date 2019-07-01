<?php

namespace DigipolisGent\API\Cache;

use Psr\SimpleCache\CacheInterface;

/**
 * Interface LoggableInterface.
 *
 * @package DigipolisGent\API\Logger
 */
interface CacheableInterface
{
  /**
   * Set the cache service.
   *
   * @param CacheInterface $cache
   */
  public function setCacheService(CacheInterface $cache);
}
