<?php

/**
 * This file is part of the ObjectSecurity package
 *
 * (c) InnovationGroup
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FivePercent\Component\ObjectSecurity;

use FivePercent\Component\ObjectSecurity\Metadata\Security;

/**
 * Authorization checker for check access to method, class or property in object
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
interface ObjectSecurityAuthorizationCheckerInterface
{
    /**
     * Is granted to class with group
     *
     * @param string|object $class
     * @param array         $attributes
     * @param string        $group
     *
     * @return bool
     */
    public function isGrantedClass($class, array $attributes = [], $group = Security::DEFAULT_GROUP);

    /**
     * Is granted to method of class with group
     *
     * @param string|object $class
     * @param string        $method
     * @param array         $attributes
     * @param string        $group
     *
     * @return bool
     */
    public function isGrantedMethod($class, $method, array $attributes = [], $group = Security::DEFAULT_GROUP);

    /**
     * Is granted method call
     *
     * @param string|object $class      Class or object for call
     * @param string        $method     Method for call
     * @param array         $arguments  Input parameters
     * @param array         $attributes Attributes
     * @param string        $group      Group
     *
     * @return bool
     */
    public function isGrantedMethodCall(
        $class,
        $method,
        array $arguments = [],
        array $attributes = [],
        $group = Security::DEFAULT_GROUP
    );
}
