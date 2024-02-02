<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Expression;

use MongoDB\BSON\Type;
use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\ExpressionInterface;
use MongoDB\Builder\Type\OperatorInterface;
use stdClass;

/**
 * Represents a single case in a $switch expression
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/switch/
 */
class CaseOperator implements ResolvesToAny, OperatorInterface
{
    public const ENCODE = Encode::FlatObject;

    /** @var ResolvesToBool|bool $case Can be any valid expression that resolves to a boolean. If the result is not a boolean, it is coerced to a boolean value. More information about how MongoDB evaluates expressions as either true or false can be found here. */
    public readonly ResolvesToBool|bool $case;

    /** @var ExpressionInterface|Type|array|bool|float|int|null|stdClass|string $then Can be any valid expression. */
    public readonly Type|ExpressionInterface|stdClass|array|bool|float|int|null|string $then;

    /**
     * @param ResolvesToBool|bool $case Can be any valid expression that resolves to a boolean. If the result is not a boolean, it is coerced to a boolean value. More information about how MongoDB evaluates expressions as either true or false can be found here.
     * @param ExpressionInterface|Type|array|bool|float|int|null|stdClass|string $then Can be any valid expression.
     */
    public function __construct(
        ResolvesToBool|bool $case,
        Type|ExpressionInterface|stdClass|array|bool|float|int|null|string $then,
    ) {
        $this->case = $case;
        $this->then = $then;
    }

    public function getOperator(): string
    {
        return '$case';
    }
}
