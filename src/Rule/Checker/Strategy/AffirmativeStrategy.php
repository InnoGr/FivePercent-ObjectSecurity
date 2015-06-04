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
 * Affirmative strategy for check rules
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class AffirmativeStrategy implements StrategyInterface
{
    /**
     * @var bool
     */
    private $allowIfAllAbstainDecisions;

    /**
     * Construct
     *
     * @param bool $allowIfAllAbstain
     */
    public function __construct($allowIfAllAbstain = false)
    {
        $this->allowIfAllAbstainDecisions = $allowIfAllAbstain;
    }

    /**
     * {@inheritDoc}
     */
    public function decide(RuleVoterInterface $voter, array $rules, array $attributes = [])
    {
        $deny = 0;

        foreach ($rules as $rule) {
            $result = $voter->vote($rule, $attributes);

            switch ($result) {
                case RuleVoterInterface::ACCESS_GRANTED:
                    return true;

                case RuleVoterInterface::ACCESS_DENIED:
                    ++$deny;
                    break;

                default:
                    break;
            }
        }

        if ($deny > 0) {
            return false;
        }

        return $this->allowIfAllAbstainDecisions;

    }
}
