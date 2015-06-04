<?php

/**
 * This file is part of the ObjectSecurity package
 *
 * (c) InnovationGroup
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FivePercent\Component\ObjectSecurity\Metadata\Loader;

/**
 * Chain metadata loader
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class ChainLoader implements LoaderInterface
{
    /**
     * @var array
     */
    private $loaders = [];

    /**
     * @var bool
     */
    private $sortedLoaders = false;

    /**
     * Construct
     *
     * @param array|LoaderInterface[] $loaders
     */
    public function __construct(array $loaders = array())
    {
        if (count($loaders)) {
            $priority = count($loaders);

            foreach ($loaders as $loader) {
                $this->addLoader($loader, --$priority);
            }
        }
    }

    /**
     * Add loader
     *
     * @param LoaderInterface $loader
     * @param int             $priority
     *
     * @return ChainLoader
     */
    public function addLoader(LoaderInterface $loader, $priority = 0)
    {
        $this->sortedLoaders = false;

        $this->loaders[spl_object_hash($loader)] = [
            'loader' => $loader,
            'priority' => $priority
        ];

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function loadForClass($class, $group)
    {
        foreach ($this->getLoaders() as $loader) {
            $metadata = $loader->loadForClass($class, $group);

            if (null !== $metadata) {
                return $metadata;
            }
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function loadForMethod($class, $method, $group)
    {
        foreach ($this->getLoaders() as $loader) {
            $metadata = $loader->loadForMethod($class, $method, $group);

            if (null !== $metadata) {
                return $metadata;
            }
        }

        return null;
    }

    /**
     * Get loaders
     *
     * @return array|LoaderInterface[]
     */
    public function getLoaders()
    {
        $this->sortCaches();

        $loaders = [];

        foreach ($this->loaders as $loaderInfo) {
            $loaders[] = $loaderInfo['loader'];
        }

        return $loaders;
    }

    /**
     * Sort caches
     */
    protected function sortCaches()
    {
        if (null !== $this->sortedLoaders) {
            return;
        }

        $this->sortedLoaders = true;

        uasort($this->loaders, function ($a, $b) {
            if ($a['priority'] == $b['priority']) {
                return 0;
            }

            return $a['priority'] > $b['priority'] ? 1 : -1;
        });
    }
}
