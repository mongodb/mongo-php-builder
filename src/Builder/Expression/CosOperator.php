<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Expression;

use MongoDB\BSON\Decimal128;
use MongoDB\BSON\Int64;
use MongoDB\Builder\Type\Encode;

/**
 * Returns the cosine of a value that is measured in radians.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/cos/
 */
readonly class CosOperator implements ResolvesToDouble, ResolvesToDecimal
{
    public const NAME = '$cos';
    public const ENCODE = Encode::Single;

    /**
     * @param Decimal128|Int64|ResolvesToNumber|float|int $expression $cos takes any valid expression that resolves to a number. If the expression returns a value in degrees, use the $degreesToRadians operator to convert the result to radians.
     * By default $cos returns values as a double. $cos can also return values as a 128-bit decimal as long as the <expression> resolves to a 128-bit decimal value.
     */
    public Decimal128|Int64|ResolvesToNumber|float|int $expression;

    /**
     * @param Decimal128|Int64|ResolvesToNumber|float|int $expression $cos takes any valid expression that resolves to a number. If the expression returns a value in degrees, use the $degreesToRadians operator to convert the result to radians.
     * By default $cos returns values as a double. $cos can also return values as a 128-bit decimal as long as the <expression> resolves to a 128-bit decimal value.
     */
    public function __construct(Decimal128|Int64|ResolvesToNumber|float|int $expression)
    {
        $this->expression = $expression;
    }
}
