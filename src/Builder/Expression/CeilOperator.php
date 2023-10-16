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
 * Returns the smallest integer greater than or equal to the specified number.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/ceil/
 */
class CeilOperator implements ResolvesToInt
{
    public const NAME = '$ceil';
    public const ENCODE = Encode::Single;

    /** @var Decimal128|Int64|ResolvesToNumber|float|int $expression If the argument resolves to a value of null or refers to a field that is missing, $ceil returns null. If the argument resolves to NaN, $ceil returns NaN. */
    public readonly Decimal128|Int64|ResolvesToNumber|float|int $expression;

    /**
     * @param Decimal128|Int64|ResolvesToNumber|float|int $expression If the argument resolves to a value of null or refers to a field that is missing, $ceil returns null. If the argument resolves to NaN, $ceil returns NaN.
     */
    public function __construct(Decimal128|Int64|ResolvesToNumber|float|int $expression)
    {
        $this->expression = $expression;
    }
}
