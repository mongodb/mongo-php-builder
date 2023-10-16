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
 * Returns the absolute value of a number.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/abs/
 */
readonly class AbsOperator implements ResolvesToNumber
{
    public const NAME = '$abs';
    public const ENCODE = Encode::Single;

    /** @param Decimal128|Int64|ResolvesToNumber|float|int $value */
    public Decimal128|Int64|ResolvesToNumber|float|int $value;

    /**
     * @param Decimal128|Int64|ResolvesToNumber|float|int $value
     */
    public function __construct(Decimal128|Int64|ResolvesToNumber|float|int $value)
    {
        $this->value = $value;
    }
}
