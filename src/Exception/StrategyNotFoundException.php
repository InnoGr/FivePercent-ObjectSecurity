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

/**
 * Control strategy not found errors
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class StrategyNotFoundException extends \Exception
{
    /**
     * Create new exception instance
     *
     * @param string     $name
     * @param int        $code
     * @param \Exception $prev
     *
     * @return StrategyNotFoundException
     */
    public static function create($name, $code = 0, \Exception $prev = null)
    {
        $message = sprintf(
            'Not found strategy with name "%s".',
            $name
        );

        return new static($message, $code, $prev);
    }
}
