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
 * Abstract rule
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
abstract class Rule implements \Serializable
{
    /**
     * {@inheritDoc}
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
