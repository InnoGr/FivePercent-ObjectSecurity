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

use FivePercent\Component\ObjectSecurity\Exception\StrategyNotFoundException;
use FivePercent\Component\ObjectSecurity\Metadata\Security;

/**
 * Base strategy manager
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class StrategyManager implements StrategyManagerInterface
{
    /**
     * @var array
     */
    private $strategies = [];

    /**
     * Add strategy
     *
     * @param string            $name
     * @param StrategyInterface $strategy
     *
     * @return StrategyManager
     */
    public function addStrategy($name, StrategyInterface $strategy)
    {
        $this->strategies[$name] = $strategy;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getStrategy($name)
    {
        if (!isset($this->strategies[$name])) {
            throw StrategyNotFoundException::create($name);
        }

        return $this->strategies[$name];
    }

    /**
     * Create default strategy manager
     *
     * @return StrategyManager
     */
    public static function createDefault()
    {
        /** @var StrategyManager $manager */
        $manager = new static();

        $manager->addStrategy(Security::STRATEGY_AFFIRMATIVE, new AffirmativeStrategy());
        $manager->addStrategy(Security::STRATEGY_CONSENSUS, new ConsensusStrategy());
        $manager->addStrategy(Security::STRATEGY_UNANIMOUS, new UnanimousStrategy());

        return $manager;
    }
}
