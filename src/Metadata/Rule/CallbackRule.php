<?php

/**
 * This file is part of the ObjectSecurity package
 *
 * (c) InnovationGroup
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FivePercent\Component\ObjectSecurity\Metadata\Rule;

use FivePercent\Component\ObjectSecurity\Metadata\Rule;

/**
 * Callback rule
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class CallbackRule extends Rule
{
    /**
     * @var callable
     */
    protected $callback;

    /**
     * Each item must be a string path for evaluate in ExpressionLanguage
     * Example: "@arguments.request.user"
     *
     * @var array
     */
    protected $arguments;

    /**
     * Construct
     *
     * @param callable $callback
     * @param array    $arguments
     */
    public function __construct($callback, array $arguments)
    {
        if (!is_callable($callback)) {
            throw new \InvalidArgumentException(sprintf(
                'The first argument must be a callable, but "%s" given. Maybe method not found?',
                is_object($callback) ? get_class($callback) : gettype($callback)
            ));
        }

        $this->callback = $callback;
        $this->arguments = $arguments;
    }

    /**
     * Get callback
     *
     * @return callable
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * Get arguments
     *
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }
}
