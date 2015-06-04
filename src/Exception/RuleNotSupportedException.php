<?php

/**
 * This file is part of the ObjectSecurity package
 *
 * (c) InnovationGroup
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FivePercent\Component\ObjectSecurity\Exception;

use FivePercent\Component\ObjectSecurity\Metadata\Rule;

/**
 * Control rule not supported errors
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class RuleNotSupportedException extends \Exception
{
    /**
     * Create new exception
     *
     * @param Rule       $rule
     * @param int        $code
     * @param \Exception $prev
     *
     * @return RuleNotSupportedException
     */
    public static function create(Rule $rule, $code = 0, \Exception $prev = null)
    {
        $message = sprintf(
            'The rule "%s" not supported.',
            get_class($rule)
        );

        return new static($message, $code, $prev);
    }
}
