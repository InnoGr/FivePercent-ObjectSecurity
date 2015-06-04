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
 * Indicate of method security
 *
 * @Annotation
 * @Target("METHOD")
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class MethodSecurity
{
    /** @var string @Enum({"affirmative", "consensus", "unanimous"}) */
    public $strategy;
    /** @var string */
    public $group = Security::DEFAULT_GROUP;
}
