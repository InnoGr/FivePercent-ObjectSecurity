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
 * Indicate for role rule
 *
 * @Annotation
 * @Target({"METHOD", "CLASS", "PROPERTY"})
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class RoleRule
{
    /** @var array @Required */
    public $roles;
    /** @var string */
    public $object;
    /** @var array */
    public $groups = [ Security::DEFAULT_GROUP ];
}
