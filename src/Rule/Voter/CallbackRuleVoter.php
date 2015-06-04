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
use FivePercent\Component\ObjectSecurity\Metadata\Rule\CallbackRule;
use FivePercent\Component\ObjectSecurity\Metadata\Rule;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

/**
 * Callback rule voter
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class CallbackRuleVoter implements RuleVoterInterface
{
    use TransformationParameterTrait;

    /**
     * @var ExpressionLanguage
     */
    private $expressionLanguage;

    /**
     * Construct
     *
     * @param ExpressionLanguage $expressionLanguage
     */
    public function __construct(ExpressionLanguage $expressionLanguage)
    {
        $this->expressionLanguage = $expressionLanguage;
    }

    /**
     * {@inheritDoc}
     */
    public function isSupported(Rule $rule)
    {
        return $rule instanceof CallbackRule;
    }

    /**
     * {@inheritDoc}
     */
    public function vote(Rule $rule, array $attributes = array())
    {
        if (!$rule instanceof CallbackRule) {
            throw UnexpectedTypeException::create($rule, CallbackRule::class);
        }

        $arguments = $rule->getArguments();

        foreach ($arguments as $key => $value) {
            $arguments[$key] = $this->transformParameter($this->expressionLanguage, $value, $attributes);
        }

        $result = call_user_func_array($rule->getCallback(), $arguments);

        if ($result === true) {
            return self::ACCESS_GRANTED;
        } elseif ($result === false) {
            return self::ACCESS_DENIED;
        } else {
            return self::ACCESS_ABSTAIN;
        }
    }
}
