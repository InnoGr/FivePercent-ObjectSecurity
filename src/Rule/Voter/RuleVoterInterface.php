<?php

/**
 * This file is part of the ObjectSecurity package
 *
 * (c) InnovationGroup
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FivePercent\Component\ObjectSecurity\Rule\Voter;

use FivePercent\Component\ObjectSecurity\Metadata\Rule;

/**
 * All rule checkers should be implemented of this interface
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
interface RuleVoterInterface
{
    const ACCESS_GRANTED = 1;
    const ACCESS_ABSTAIN = 0;
    const ACCESS_DENIED  = -1;

    /**
     * Is supported
     *
     * @param Rule $rule
     */
    public function isSupported(Rule $rule);

    /**
     * Vote
     *
     * @param Rule  $rule
     * @param array $attributes
     *
     * @return int
     */
    public function vote(Rule $rule, array $attributes = array());
}
