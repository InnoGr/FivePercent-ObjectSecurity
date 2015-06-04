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
 * All metadata loaders should be implemented of this interface
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
interface LoaderInterface
{
    /**
     * Load for class
     *
     * @param string $class
     * @param string $group
     *
     * @return \FivePercent\Component\ObjectSecurity\Metadata\Security\ClassSecurity|null
     */
    public function loadForClass($class, $group);

    /**
     * Load for method
     *
     * @param string $class
     * @param string $method
     * @param string $group
     *
     * @return \FivePercent\Component\ObjectSecurity\Metadata\Security\MethodSecurity|null
     */
    public function loadForMethod($class, $method, $group);
}
