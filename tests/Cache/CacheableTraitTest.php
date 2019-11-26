<?php

declare(strict_types=1);

namespace DigipolisGent\API\Tests\Cache;

use DigipolisGent\API\Cache\CacheableTrait;
use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheInterface;

/**
 * @covers \DigipolisGent\API\Cache\CacheableTrait
 */
class CacheableTraitTest extends TestCase
{
    use CacheableTrait;

    /**
     * False is returned is cache is set without cache service.
     *
     * @test
     */
    public function cacheSetWithoutCache(): void
    {
        $key = uniqid();
        $value = uniqid();

        $this->assertFalse($this->cacheSet($key, $value));
    }

    /**
     * False is returned if cache is deleted without cache service.
     *
     * @test
     */
    public function cacheDeletedWithoutCache(): void
    {
        $key = uniqid();

        $this->assertFalse($this->cacheDelete($key));
    }

    /**
     * False is returned when all cache is cleared without cache service.
     *
     * @test
     */
    public function cacheClearWithoutCache(): void
    {
        $this->assertFalse($this->cacheClear());
    }

    /**
     * Null is returned when item is retrieved from cache without cache service.
     *
     * @test
     */
    public function cacheGetWithoutCache(): void
    {
        $key = uniqid();

        $this->assertNull($this->cacheGet($key));
    }

    /**
     * True is returned when value is stored in cache service.
     *
     * @test
     */
    public function cacheSetWithCache(): void
    {
        $key = uniqid();
        $value = uniqid();
        $ttl = 7200;

        $cacheService = $this->prophesize(CacheInterface::class);
        $cacheService
            ->set($key, $value, $ttl)
            ->willReturn(true)
            ->shouldBeCalled();
        $this->setCacheService($cacheService->reveal());

        $this->assertTrue($this->cacheSet($key, $value, $ttl));
    }

    /**
     * True is returned when the value is deleted from the cache service.
     *
     * @test
     */
    public function cacheDeletedWithCache(): void
    {
        $key = uniqid();

        $cacheService = $this->prophesize(CacheInterface::class);
        $cacheService
            ->delete($key)
            ->willReturn(true)
            ->shouldBeCalled();
        $this->setCacheService($cacheService->reveal());

        $this->assertTrue($this->cacheDelete($key));
    }

    /**
     * True is returned when all cache is cleared from cache service.
     *
     * @test
     */
    public function cacheClearWithCache(): void
    {
        $cacheService = $this->prophesize(CacheInterface::class);
        $cacheService
            ->clear()
            ->willReturn(true)
            ->shouldBeCalled();
        $this->setCacheService($cacheService->reveal());

        $this->assertTrue($this->cacheClear());
    }

    /**
     * Value can be retrieved from the cache backend.
     *
     * @test
     */
    public function cacheGetWithCache()
    {
        $key = uniqid();
        $value = uniqid();

        $cacheService = $this->prophesize(CacheInterface::class);
        $cacheService
            ->get($key, null)
            ->willReturn($value)
            ->shouldBeCalled();
        $this->setCacheService($cacheService->reveal());

        $this->assertEquals($value, $this->cacheGet($key));
    }
}
