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

use FivePercent\Component\ObjectSecurity\Metadata\Loader\LoaderInterface;

/**
 * Base metadata factory.
 * Load metadata via loader system
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class MetadataFactory implements MetadataFactoryInterface
{
    /**
     * @var LoaderInterface
     */
    private $loader;

    /**
     * Construct
     *
     * @param LoaderInterface $loader
     */
    public function __construct(LoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    /**
     * {@inheritDoc}
     */
    public function loadForClass($class, $group = Security::DEFAULT_GROUP)
    {
        return $this->loader->loadForClass($class, $group);
    }

    /**
     * {@inheritDoc}
     */
    public function loadForMethod($class, $method, $group = Security::DEFAULT_GROUP)
    {
        return $this->loader->loadForMethod($class, $method, $group);
    }
}
