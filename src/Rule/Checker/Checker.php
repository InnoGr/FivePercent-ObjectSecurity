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
use FivePercent\Component\ObjectSecurity\Rule\Voter\RuleVoterInterface;
use FivePercent\Component\ObjectSecurity\Rule\Checker\Strategy\StrategyManagerInterface;

/**
 * Base checker for check rules
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class Checker implements CheckerInterface
{
    /**
     * @var RuleVoterInterface
     */
    private $ruleVoter;

    /**
     * @var StrategyManagerInterface
     */
    private $strategyManager;

    /**
     * Construct
     *
     * @param RuleVoterInterface       $ruleVoter
     * @param StrategyManagerInterface $strategyManager
     */
    public function __construct(RuleVoterInterface $ruleVoter, StrategyManagerInterface $strategyManager)
    {
        $this->ruleVoter = $ruleVoter;
        $this->strategyManager = $strategyManager;
    }

    /**
     * {@inheritDoc}
     */
    public function decide(array $rules, array $attributes = [], $strategy = Security::STRATEGY_AFFIRMATIVE)
    {
        $strategy = $this->strategyManager->getStrategy($strategy);

        return $strategy->decide($this->ruleVoter, $rules, $attributes);
    }
}
