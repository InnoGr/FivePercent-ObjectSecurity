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

use FivePercent\Component\Exception\UnexpectedTypeException;
use FivePercent\Component\ObjectSecurity\Exception\RuleVotingException;
use FivePercent\Component\ObjectSecurity\Metadata\Rule\RoleRule;
use FivePercent\Component\ObjectSecurity\Metadata\Rule;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Rule voter interface
 * The package "symfony/security" must be installed for use this voter.
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class RoleRuleVoter implements RuleVoterInterface
{
    use TransformationParameterTrait;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * @var ExpressionLanguage
     */
    private $expressionLanguage;

    /**
     * Constructor
     *
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param ExpressionLanguage            $expressionLanguage
     */
    public function __construct(
        AuthorizationCheckerInterface $authorizationChecker,
        ExpressionLanguage $expressionLanguage
    ) {
        $this->authorizationChecker = $authorizationChecker;
        $this->expressionLanguage = $expressionLanguage;
    }

    /**
     * {@inheritDoc}
     */
    public function isSupported(Rule $rule)
    {
        return $rule instanceof RoleRule;
    }

    /**
     * {@inheritDoc}
     */
    public function vote(Rule $rule, array $attributes = array())
    {
        if (!$rule instanceof RoleRule) {
            throw UnexpectedTypeException::create($rule, RoleRule::class);
        }

        $object = null;

        if ($rule->getObject()) {
            $object = $this->transformParameter($this->expressionLanguage, $rule->getObject(), $attributes);

            if (null !== $object && !is_object($object)) {
                throw new RuleVotingException(sprintf(
                    'Can not transform object from parameter "%s" for RoleRuleVoter. ' .
                    'Available keys in attributes: "%s". Returned value: "%s" but this is not object. ' .
                    'Maybe incorrect evaluate?',
                    $object,
                    implode('", "', array_keys($attributes)),
                    is_scalar($object) ? $object : gettype($object)
                ));
            }
        }

        $status = $this->authorizationChecker->isGranted($rule->getRoles(), $object);

        if ($status === true) {
            return self::ACCESS_GRANTED;
        } elseif ($status === false) {
            return self::ACCESS_DENIED;
        } else {
            return self::ACCESS_ABSTAIN;
        }
    }
}
