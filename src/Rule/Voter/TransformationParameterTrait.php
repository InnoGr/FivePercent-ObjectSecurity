<?php

/**
 * This file is part of the ObjectSecurity package
 *
 * (c) InnovationGroup
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FivePercent\Component\ObjectSecurity\Rule\Voter;

use FivePercent\Component\ObjectSecurity\Exception\RuleVotingException;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

/**
 * Transformation parameter trait
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
trait TransformationParameterTrait
{
    /**
     * Transform parameter
     *
     * @param ExpressionLanguage $expressionLanguage
     * @param string             $parameter
     * @param array              $attributes
     *
     * @return mixed
     *
     * @throws RuleVotingException
     */
    public function transformParameter(ExpressionLanguage $expressionLanguage, $parameter, array $attributes)
    {
        $result = $parameter;

        if ($parameter[0] === '@') {
            $parameter = substr($parameter, 1);
            $result = $expressionLanguage->evaluate($parameter, $attributes);
        } elseif ($parameter[0] === '=') {
            // Try get via property accessor
            if (!interface_exists('Symfony\Component\PropertyAccess\PropertyAccessorInterface')) {
                throw new \RuntimeException(
                    'Could not PropertyAccessor for get value, because package not installed.'
                );
            }

            $parameter = substr($parameter, 1);
            $propertyAccessor = new PropertyAccessor();
            $result = $propertyAccessor->getValue($attributes, $parameter);
        }

        return $result;
    }
}
