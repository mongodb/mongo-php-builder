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
 * Calculates the square root.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/sqrt/
 */
class SqrtOperator implements ResolvesToDouble
{
    public const NAME = '$sqrt';
    public const ENCODE = Encode::Single;

    /** @var Decimal128|Int64|ResolvesToNumber|float|int $number The argument can be any valid expression as long as it resolves to a non-negative number. */
    public readonly Decimal128|Int64|ResolvesToNumber|float|int $number;

    /**
     * @param Decimal128|Int64|ResolvesToNumber|float|int $number The argument can be any valid expression as long as it resolves to a non-negative number.
     */
    public function __construct(Decimal128|Int64|ResolvesToNumber|float|int $number)
    {
        $this->number = $number;
    }
}
