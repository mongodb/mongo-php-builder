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
 * Returns the largest integer less than or equal to the specified number.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/floor/
 */
readonly class FloorOperator implements ResolvesToInt
{
    public const NAME = '$floor';
    public const ENCODE = Encode::Single;

    /** @param Decimal128|Int64|ResolvesToNumber|float|int $expression */
    public Decimal128|Int64|ResolvesToNumber|float|int $expression;

    /**
     * @param Decimal128|Int64|ResolvesToNumber|float|int $expression
     */
    public function __construct(Decimal128|Int64|ResolvesToNumber|float|int $expression)
    {
        $this->expression = $expression;
    }
}
