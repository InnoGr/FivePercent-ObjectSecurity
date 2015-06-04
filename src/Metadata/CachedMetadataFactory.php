<?php

/**
 * This file is part of the ObjectSecurity package
 *
 * (c) InnovationGroup
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FivePercent\Component\ObjectSecurity\Metadata;

use FivePercent\Component\Cache\CacheInterface;

/**
 * Cached metadata factory
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class CachedMetadataFactory implements MetadataFactoryInterface
{
    /**
     * @var MetadataFactoryInterface
     */
    private $delegate;

    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * Construct
     *
     * @param MetadataFactoryInterface $delegate
     * @param CacheInterface           $cache
     */
    public function __construct(MetadataFactoryInterface $delegate, CacheInterface $cache)
    {
        $this->delegate = $delegate;
        $this->cache = $cache;
    }

    /**
     * {@inheritDoc}
     */
    public function loadForClass($class, $group = Security::DEFAULT_GROUP)
    {
        $key = 'security.metadata.class:' . $class . ':' . $group;

        $metadata = $this->cache->get($key);

        if (!$metadata) {
            $metadata = $this->delegate->loadForClass($class, $group);
            $this->cache->set($key, $metadata);
        }

        return $metadata;
    }

    /**
     * {@inheritDoc}
     */
    public function loadForMethod($class, $method, $group = Security::DEFAULT_GROUP)
    {
        $key = 'security.metadata.method:' . $class . ':' . $method . ':' . $group;

        $metadata = $this->cache->get($key);

        if (!$metadata) {
            $metadata = $this->delegate->loadForMethod($class, $method, $group);
            $this->cache->set($key, $metadata);
        }

        return $metadata;
    }
}
