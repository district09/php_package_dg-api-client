<?php

namespace DigipolisGent\API\Tests\Cache;

use DigipolisGent\API\Cache\CacheableTrait;
use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheInterface;

class CacheableTraitTest extends TestCase
{
    use CacheableTrait;

    public function testCacheSetWithoutCache()
    {
        $key = uniqid();
        $value = uniqid();
        $this->assertFalse($this->cacheSet($key, $value));
    }

    public function testCacheDeletetWithoutCache()
    {
        $key = uniqid();
        $this->assertFalse($this->cacheDelete($key));
    }

    public function testCacheClearWithoutCache()
    {
        $this->assertFalse($this->cacheClear());
    }

    public function testCacheGetWithoutCache()
    {
        $key = uniqid();
        $this->assertNull($this->cacheGet($key));
    }

    public function testCacheSetWithCache()
    {
        $cache = $this->getCacheService();
        $key = uniqid();
        $value = uniqid();
        $cache
            ->expects($this->once())
            ->method('set')
            ->with($key, $value)
            ->willReturn(true);
        $this->assertTrue($this->cacheSet($key, $value));
    }

    public function testCacheDeletetWithCache()
    {
        $cache = $this->getCacheService();
        $key = uniqid();
        $cache
            ->expects($this->once())
            ->method('delete')
            ->with($key)
            ->willReturn(true);
        $this->assertTrue($this->cacheDelete($key));
    }

    public function testCacheClearWithCache()
    {
         $cache = $this->getCacheService();
        $cache
            ->expects($this->once())
            ->method('clear')
            ->willReturn(true);
        $this->assertTrue($this->cacheClear());
    }

    public function testCacheGetWithCache()
    {
        $cache = $this->getCacheService();
        $key = uniqid();
        $value = uniqid();
        $cache
            ->expects($this->once())
            ->method('get')
            ->with($key)
            ->willReturn($value);
        $this->assertEquals($value, $this->cacheGet($key));
    }

    protected function getCacheService()
    {
        $cacheService = $this->getMockBuilder(CacheInterface::class)->getMock();
        $this->setCacheService($cacheService);

        return $cacheService;
    }
}
