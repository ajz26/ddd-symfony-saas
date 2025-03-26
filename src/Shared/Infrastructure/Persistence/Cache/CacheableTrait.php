<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Cache;

use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

trait CacheableTrait
{
    private CacheInterface $cache;
    private const CACHE_TTL = 3600;
    private const CACHE_PREFIX = 'client_';

    protected function cacheItem(string $key, callable $callback, int $ttl = self::CACHE_TTL)
    {
        return $this->cache->get($key, function (ItemInterface $item) use ($callback, $ttl) {
            $item->expiresAfter($ttl);
            return $callback();
        });
    }

    protected function invalidateCache(string $pattern): void
    {
        $this->cache->delete($pattern);
    }

    protected function getCacheKey(string $method, array $params = []): string
    {
        $params = array_map(function($param) {
            return preg_replace('/[{}()\\\\\/@:"]/', '_', (string)$param);
        }, $params);

        return self::CACHE_PREFIX . $method . '_' . implode('_', $params);
    }
} 