<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Expression;

use MongoDB\BSON\Document;
use MongoDB\BSON\Serializable;
use MongoDB\BSON\Type;
use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\ExpressionInterface;
use MongoDB\Builder\Type\OperatorInterface;
use stdClass;

/**
 * Defines variables for use within the scope of a subexpression and returns the result of the subexpression. Accepts named parameters.
 * Accepts any number of argument expressions.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/let/
 */
class LetOperator implements ResolvesToAny, OperatorInterface
{
    public const ENCODE = Encode::Object;

    /**
     * @var Document|Serializable|array|stdClass $vars Assignment block for the variables accessible in the in expression. To assign a variable, specify a string for the variable name and assign a valid expression for the value.
     * The variable assignments have no meaning outside the in expression, not even within the vars block itself.
     */
    public readonly Document|Serializable|stdClass|array $vars;

    /** @var ExpressionInterface|Type|array|bool|float|int|non-empty-string|null|stdClass $in The expression to evaluate. */
    public readonly Type|ExpressionInterface|stdClass|array|bool|float|int|null|string $in;

    /**
     * @param Document|Serializable|array|stdClass $vars Assignment block for the variables accessible in the in expression. To assign a variable, specify a string for the variable name and assign a valid expression for the value.
     * The variable assignments have no meaning outside the in expression, not even within the vars block itself.
     * @param ExpressionInterface|Type|array|bool|float|int|non-empty-string|null|stdClass $in The expression to evaluate.
     */
    public function __construct(
        Document|Serializable|stdClass|array $vars,
        Type|ExpressionInterface|stdClass|array|bool|float|int|null|string $in,
    ) {
        $this->vars = $vars;
        $this->in = $in;
    }

    public function getOperator(): string
    {
        return '$let';
    }
}
