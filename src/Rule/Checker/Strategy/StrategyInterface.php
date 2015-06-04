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

use FivePercent\Component\ObjectSecurity\Rule\Voter\RuleVoterInterface;

/**
 * All checker strategy should be implemented of this interface
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
interface StrategyInterface
{
    /**
     * Check rules
     *
     * @param RuleVoterInterface                                    $voter
     * @param array|\FivePercent\Component\ObjectSecurity\Metadata\Rule[] $rules
     * @param array                                                 $attributes
     *
     * @return bool
     */
    public function decide(RuleVoterInterface $voter, array $rules, array $attributes = []);
}
