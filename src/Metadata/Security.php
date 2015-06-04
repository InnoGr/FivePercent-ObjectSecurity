<?php

/**
 * This file is part of the ObjectSecurity package
 *
 * (c) InnovationGroup
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FivePercent\Component\ObjectSecurity\Metadata;

/**
 * Base security metadata
 * Attention: all properties for next serialize must be a public or protected!
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
abstract class Security implements \Serializable
{
    const DEFAULT_GROUP = 'Default';

    const STRATEGY_AFFIRMATIVE      = 'affirmative';
    const STRATEGY_CONSENSUS        = 'consensus';
    const STRATEGY_UNANIMOUS        = 'unanimous';

    /**
     * @var array|Rule[]
     */
    protected $rules = array();

    /**
     * @var string
     */
    protected $strategy = self::STRATEGY_AFFIRMATIVE;

    /**
     * @var array
     */
    protected $group = self::DEFAULT_GROUP;

    /**
     * {@inheritDoc}
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * {@inheritDoc}
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * {@inheritDoc}
     */
    public function getStrategy()
    {
        return $this->strategy;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        $data = array();

        foreach ($this as $key => $value) {
            $data[$key] = $value;
        }

        return serialize($data);
    }

    /**
     * {@inheritDoc}
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);

        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
