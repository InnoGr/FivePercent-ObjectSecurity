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
 * Class security
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class ClassSecurity extends Security
{
    /**
     * @var string
     */
    protected $class;

    /**
     * Construct
     *
     * @param string                                                $class
     * @param string                                                $strategy
     * @param array|\FivePercent\Component\ObjectSecurity\Metadata\Rule[] $rules
     * @param string                                                $group
     */
    public function __construct($class, $strategy, array $rules, $group)
    {
        $this->class = $class;
        $this->strategy = $strategy;
        $this->rules = $rules;
        $this->group = $group;
    }

    /**
     * Get class
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }
}
