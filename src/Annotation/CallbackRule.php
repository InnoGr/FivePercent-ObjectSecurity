<?php

/**
 * This file is part of the ObjectSecurity package
 *
 * (c) InnovationGroup
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FivePercent\Component\ObjectSecurity\Annotation;

use FivePercent\Component\ObjectSecurity\Metadata\Security;

/**
 * Indicate of callback rule
 *
 * @Annotation
 * @Target({"CLASS", "METHOD", "PROPERTY"})
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class CallbackRule
{
    /** @var array @Required */
    public $callback;
    /** @var array */
    public $arguments = [];
    /** @var array */
    public $groups = [ Security::DEFAULT_GROUP ];
}
