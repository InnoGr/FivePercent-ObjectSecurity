<?php

/**
 * This file is part of the ObjectSecurity package
 *
 * (c) InnovationGroup
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FivePercent\Component\ObjectSecurity\Rule\Checker\Strategy;

/**
 * All strategy managers should be implemented of this interface
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
interface StrategyManagerInterface
{
    /**
     * Get strategy
     *
     * @param string $name
     *
     * @return StrategyInterface
     */
    public function getStrategy($name);
}
