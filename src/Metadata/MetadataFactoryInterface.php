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

/**
 * All metadata factories should be implemented of this interface
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
interface MetadataFactoryInterface
{
    /**
     * Load metadata for class
     *
     * @param string|object $class
     * @param string        $group
     *
     * @return Security\ClassSecurity|null
     */
    public function loadForClass($class, $group = Security::DEFAULT_GROUP);

    /**
     * Load metadata for method
     *
     * @param string|object $class
     * @param string        $method
     * @param string        $group
     *
     * @return Security\MethodSecurity|null
     */
    public function loadForMethod($class, $method, $group = Security::DEFAULT_GROUP);
}
