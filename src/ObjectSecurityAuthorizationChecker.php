<?php

/**
 * This file is part of the ObjectSecurity package
 *
 * (c) InnovationGroup
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FivePercent\Component\ObjectSecurity;

use FivePercent\Component\ObjectSecurity\Metadata\MetadataFactoryInterface;
use FivePercent\Component\ObjectSecurity\Metadata\Security;
use FivePercent\Component\ObjectSecurity\Rule\Checker\CheckerInterface;

/**
 * Authorization checker
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class ObjectSecurityAuthorizationChecker implements ObjectSecurityAuthorizationCheckerInterface
{
    /**
     * @var MetadataFactoryInterface
     */
    private $metadataFactory;

    /**
     * @var CheckerInterface
     */
    private $ruleChecker;

    /**
     * Constructor.
     *
     * @param MetadataFactoryInterface       $metadataFactory
     * @param CheckerInterface               $ruleChecker
     */
    public function __construct(
        MetadataFactoryInterface $metadataFactory,
        CheckerInterface $ruleChecker
    ) {
        $this->metadataFactory = $metadataFactory;
        $this->ruleChecker = $ruleChecker;
    }

    /**
     * {@inheritDoc}
     */
    public function isGrantedClass($class, array $attributes = [], $group = Security::DEFAULT_GROUP)
    {
        $security = $this->metadataFactory->loadForClass($class, $group);

        if (!$security) {
            return true;
        }

        return $this->ruleChecker->decide($security->getRules(), $attributes, $security->getStrategy());
    }

    /**
     * {@inheritDoc}
     */
    public function isGrantedMethod($class, $method, array $attributes = [], $group = Security::DEFAULT_GROUP)
    {
        $security = $this->metadataFactory->loadForMethod($class, $method, $group);

        if (!$security) {
            return true;
        }

        return $this->ruleChecker->decide($security->getRules(), $attributes, $security->getStrategy());
    }

    /**
     * {@inheritDoc}
     */
    public function isGrantedMethodCall(
        $class,
        $method,
        array $arguments = [],
        array $attributes = [],
        $group = Security::DEFAULT_GROUP
    ) {
        // @todo: check array for replace argument names
        $attributes['arguments'] = $arguments;

        return $this->isGrantedMethod($class, $method, $attributes, $group);
    }

    /**
     * Get metadata factory
     *
     * @return MetadataFactoryInterface
     */
    public function getMetadataFactory()
    {
        return $this->metadataFactory;
    }
}
