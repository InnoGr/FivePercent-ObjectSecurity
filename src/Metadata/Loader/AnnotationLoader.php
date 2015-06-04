<?php

/**
 * This file is part of the ObjectSecurity package
 *
 * (c) InnovationGroup
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FivePercent\Component\ObjectSecurity\Metadata\Loader;

use Doctrine\Common\Annotations\Reader;
use FivePercent\Component\Reflection\Reflection;
use FivePercent\Component\ObjectSecurity\Annotation\CallbackRule as CallbackRuleAnnotation;
use FivePercent\Component\ObjectSecurity\Annotation\ClassSecurity as ClassSecurityAnnotation;
use FivePercent\Component\ObjectSecurity\Annotation\MethodSecurity as MethodSecurityAnnotation;
use FivePercent\Component\ObjectSecurity\Annotation\RoleRule as RoleRuleAnnotation;
use FivePercent\Component\ObjectSecurity\Metadata\Rule\CallbackRule;
use FivePercent\Component\ObjectSecurity\Metadata\Rule\RoleRule;
use FivePercent\Component\ObjectSecurity\Metadata\Security\ClassSecurity;
use FivePercent\Component\ObjectSecurity\Metadata\Security\MethodSecurity;
use FivePercent\Component\ObjectSecurity\Metadata\Security;

/**
 * Annotation loader
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class AnnotationLoader implements LoaderInterface
{
    /**
     * @var Reader
     */
    private $reader;

    /**
     * Construct
     *
     * @param Reader $reader
     */
    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * {@inheritDoc}
     */
    public function loadForClass($class, $group)
    {
        $reflectionClass = Reflection::loadClassReflection($class);

        $classAnnotations = $this->reader->getClassAnnotations($reflectionClass);

        $securityClassAnnotation = null;
        $rules = array();

        foreach ($classAnnotations as $classAnnotation) {
            if ($classAnnotation instanceof ClassSecurityAnnotation && $group == $classAnnotation->group) {
                if ($securityClassAnnotation) {
                    throw new \RuntimeException(sprintf(
                        'The @ClassSecurity annotation already defined in class "%s".',
                        $reflectionClass->getName()
                    ));
                }

                $securityClassAnnotation = $classAnnotation;
            }

            if ($rule = $this->transformAnnotationToRule($classAnnotation, $group, $class)) {
                $rules[] = $rule;
            }
        }

        if (!$securityClassAnnotation && !count($rules)) {
            return null;
        }

        if ($securityClassAnnotation) {
            $strategy = $securityClassAnnotation->strategy;
        } else {
            $strategy = Security::STRATEGY_AFFIRMATIVE;
        }

        $securityClass = new ClassSecurity(
            $reflectionClass->getName(),
            $strategy,
            $rules,
            $group
        );

        return $securityClass;
    }

    /**
     * {@inheritDoc}
     */
    public function loadForMethod($class, $method, $group)
    {
        $methodReflection = Reflection::loadMethodReflection($class, $method);

        $methodAnnotations = $this->reader->getMethodAnnotations($methodReflection);

        $securityMethodAnnotation = null;
        $rules = array();

        foreach ($methodAnnotations as $methodAnnotation) {
            if ($methodAnnotation instanceof MethodSecurityAnnotation && $group == $methodAnnotation->group) {
                if ($securityMethodAnnotation) {
                    throw new \RuntimeException(sprintf(
                        'The @MethodSecurity annotation already defined in method "%s::%s".',
                        $class,
                        $method
                    ));
                }

                $securityMethodAnnotation = $methodAnnotation;
            }

            if ($rule = $this->transformAnnotationToRule($methodAnnotation, $group, $class)) {
                $rules[] = $rule;
            }
        }

        if (!$securityMethodAnnotation && !count($rules)) {
            return null;
        }

        if ($securityMethodAnnotation) {
            $strategy = $securityMethodAnnotation->strategy;
        } else {
            $strategy = Security::STRATEGY_AFFIRMATIVE;
        }

        $securityMethod = new MethodSecurity(
            $class,
            $method,
            $strategy,
            $rules,
            $group
        );

        return $securityMethod;
    }

    /**
     * Transform rule for annotation
     *
     * @param object $annotation
     * @param string $group
     * @param string $class
     *
     * @return \FivePercent\Component\ObjectSecurity\Metadata\Rule|null
     */
    private function transformAnnotationToRule($annotation, $group, $class)
    {
        if ($annotation instanceof RoleRuleAnnotation && in_array($group, $annotation->groups)) {
            return new RoleRule($annotation->roles, $annotation->object);
        }

        if ($annotation instanceof CallbackRuleAnnotation && in_array($group, $annotation->groups)) {
            $callback = $annotation->callback;

            if (isset($callback[0]) && $callback[0] == 'self') {
                $callback[0] = $class;
            }

            return new CallbackRule($callback, $annotation->arguments);
        }

        return null;
    }
}
