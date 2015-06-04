<?php

/**
 * This file is part of the ObjectSecurity package
 *
 * (c) InnovationGroup
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FivePercent\Component\ObjectSecurity\Metadata\Security;

use FivePercent\Component\ObjectSecurity\Metadata\Security;

/**
 * Method security metadata
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class MethodSecurity extends Security
{
    /**
     * @var string
     */
    protected $class;

    /**
     * @var string
     */
    protected $method;

    /**
     * Construct
     *
     * @param string $class
     * @param string $method
     * @param string $strategy
     * @param array  $rules
     * @param string $group
     */
    public function __construct($class, $method, $strategy, array $rules, $group)
    {
        $this->class = $class;
        $this->method = $method;
        $this->strategy = $strategy;
        $this->rules = $rules;
        $this->group = $group;
    }
}
