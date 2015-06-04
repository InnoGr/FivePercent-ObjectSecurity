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
 * Check by roles
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class RoleRule extends Rule
{
    /**
     * @var array|string[]
     */
    protected $roles;

    /**
     * Path to object.
     * Example: "@arguments.request.user"
     *
     * @var string
     */
    protected $object;

    /**
     * Construct
     *
     * @param array|string[] $roles
     * @param string         $object
     */
    public function __construct(array $roles, $object)
    {
        $this->roles = $roles;
        $this->object = $object;
    }

    /**
     * Get roles
     *
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Get object
     *
     * @return string
     */
    public function getObject()
    {
        return $this->object;
    }
}
