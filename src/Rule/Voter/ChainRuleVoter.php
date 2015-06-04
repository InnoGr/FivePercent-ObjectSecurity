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

use FivePercent\Component\ObjectSecurity\Exception\RuleNotSupportedException;
use FivePercent\Component\ObjectSecurity\Metadata\Rule;

/**
 * Chain rule voter
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class ChainRuleVoter implements RuleVoterInterface
{
    /**
     * @var array|RuleVoterInterface[]
     */
    private $voters = array();

    /**
     * Construct
     *
     * @param array|RuleVoterInterface $voters
     */
    public function __construct(array $voters = [])
    {
        foreach ($voters as $voter) {
            $this->addVoter($voter);
        }
    }

    /**
     * Add voter
     *
     * @param RuleVoterInterface $voter
     *
     * @return ChainRuleVoter
     */
    public function addVoter(RuleVoterInterface $voter)
    {
        $this->voters[spl_object_hash($voter)] = $voter;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function isSupported(Rule $rule)
    {
        foreach ($this->voters as $voter) {
            if (true === $voter->isSupported($rule)) {
                return true;
            }
        }

        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function vote(Rule $rule, array $attributes = array())
    {
        foreach ($this->voters as $voter) {
            if (true === $voter->isSupported($rule)) {
                return $voter->vote($rule, $attributes);
            }
        }

        throw RuleNotSupportedException::create($rule);
    }
}
