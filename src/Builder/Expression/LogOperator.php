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
 * Calculates the log of a number in the specified base.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/log/
 */
class LogOperator implements ResolvesToDouble
{
    public const NAME = '$log';
    public const ENCODE = Encode::Array;

    /** @var Decimal128|Int64|ResolvesToNumber|float|int $number Any valid expression as long as it resolves to a non-negative number. */
    public readonly Decimal128|Int64|ResolvesToNumber|float|int $number;

    /** @var Decimal128|Int64|ResolvesToNumber|float|int $base Any valid expression as long as it resolves to a positive number greater than 1. */
    public readonly Decimal128|Int64|ResolvesToNumber|float|int $base;

    /**
     * @param Decimal128|Int64|ResolvesToNumber|float|int $number Any valid expression as long as it resolves to a non-negative number.
     * @param Decimal128|Int64|ResolvesToNumber|float|int $base Any valid expression as long as it resolves to a positive number greater than 1.
     */
    public function __construct(
        Decimal128|Int64|ResolvesToNumber|float|int $number,
        Decimal128|Int64|ResolvesToNumber|float|int $base,
    ) {
        $this->number = $number;
        $this->base = $base;
    }
}
