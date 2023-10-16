<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Expression;

use MongoDB\BSON\Type;
use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\ExpressionInterface;
use stdClass;

/**
 * Converts value to a boolean.
 * New in version 4.0.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/toBool/
 */
readonly class ToBoolOperator implements ResolvesToBool
{
    public const NAME = '$toBool';
    public const ENCODE = Encode::Single;

    /** @param ExpressionInterface|Type|array|bool|float|int|non-empty-string|null|stdClass $expression */
    public Type|ExpressionInterface|stdClass|array|bool|float|int|null|string $expression;

    /**
     * @param ExpressionInterface|Type|array|bool|float|int|non-empty-string|null|stdClass $expression
     */
    public function __construct(Type|ExpressionInterface|stdClass|array|bool|float|int|null|string $expression)
    {
        $this->expression = $expression;
    }
}
