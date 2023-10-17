<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Expression;

use MongoDB\BSON\Decimal128;
use MongoDB\BSON\Int64;
use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\OperatorInterface;

/**
 * Converts a value from radians to degrees.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/radiansToDegrees/
 */
class RadiansToDegreesOperator implements ResolvesToDouble, ResolvesToDecimal, OperatorInterface
{
    public const ENCODE = Encode::Single;

    /** @var Decimal128|Int64|ResolvesToNumber|float|int $expression */
    public readonly Decimal128|Int64|ResolvesToNumber|float|int $expression;

    /**
     * @param Decimal128|Int64|ResolvesToNumber|float|int $expression
     */
    public function __construct(Decimal128|Int64|ResolvesToNumber|float|int $expression)
    {
        $this->expression = $expression;
    }

    public function getOperator(): string
    {
        return '$radiansToDegrees';
    }
}
