<?php

/**
 * This file is part of the ObjectSecurity package
 *
 * (c) InnovationGroup
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FivePercent\Component\ObjectSecurity\Rule\Checker;

use FivePercent\Component\ObjectSecurity\Metadata\Security;

/**
 * All rule security checkers should be implemented of this interface
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
interface CheckerInterface
{
    /**
     * Check rules with strategy
     *
     * @param array|\FivePercent\Component\ObjectSecurity\Metadata\Rule[] $rules
     * @param array                                                 $attributes
     * @param string                                                $strategy
     *
     * @return bool
     */
    public function decide(array $rules, array $attributes = [], $strategy = Security::STRATEGY_AFFIRMATIVE);
}
