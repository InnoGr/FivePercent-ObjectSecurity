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
 * Indicate of class security
 *
 * @Annotation
 * @Target("CLASS")
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class ClassSecurity
{
    /** @var string @Enum({"affirmative", "consensus", "unanimous"}) */
    public $strategy = 'affirmative';
    /** @var string */
    public $group = Security::DEFAULT_GROUP;
}
