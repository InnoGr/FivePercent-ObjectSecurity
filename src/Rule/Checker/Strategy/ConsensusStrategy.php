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
 * Consensus strategy
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class ConsensusStrategy implements StrategyInterface
{
    /**
     * @var bool
     */
    private $allowIfEqualGrantedDeniedDecisions;

    /**
     * @var bool
     */
    private $allowIfAllAbstainDecisions;

    /**
     * Construct
     *
     * @param bool $allowIfEqualsGrantedDenied
     * @param bool $allowIfAllAbstain
     */
    public function __construct($allowIfEqualsGrantedDenied = false, $allowIfAllAbstain = false)
    {
        $this->allowIfEqualGrantedDeniedDecisions = $allowIfEqualsGrantedDenied;
        $this->allowIfAllAbstainDecisions = $allowIfAllAbstain;
    }

    /**
     * {@inheritDoc}
     */
    public function decide(RuleVoterInterface $voter, array $rules, array $attributes = [])
    {
        $grant = 0;
        $deny = 0;
        $abstain = 0;

        foreach ($rules as $rule) {
            $result = $voter->vote($rule, $attributes);

            switch ($result) {
                case RuleVoterInterface::ACCESS_GRANTED:
                    ++$grant;

                    break;

                case RuleVoterInterface::ACCESS_DENIED:
                    ++$deny;

                    break;

                default:
                    ++$abstain;

                    break;
            }
        }

        if ($grant > $deny) {
            return true;
        }

        if ($deny > $grant) {
            return false;
        }

        if ($grant == $deny && $grant != 0) {
            return $this->allowIfEqualGrantedDeniedDecisions;
        }

        return $this->allowIfAllAbstainDecisions;
    }
}
