<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Expression;

use MongoDB\BSON\Decimal128;
use MongoDB\BSON\Int64;
use MongoDB\BSON\PackedArray;
use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\OperatorInterface;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Model\BSONArray;

use function array_is_list;
use function is_array;

/**
 * Returns an approximation of the median, the 50th percentile, as a scalar value.
 * New in MongoDB 7.0.
 * This operator is available as an accumulator in these stages:
 * $group
 * $setWindowFields
 * It is also available as an aggregation expression.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/median/
 */
class MedianOperator implements ResolvesToDouble, OperatorInterface
{
    public const ENCODE = Encode::Object;

    /** @var BSONArray|Decimal128|Int64|PackedArray|ResolvesToNumber|array|float|int $input $median calculates the 50th percentile value of this data. input must be a field name or an expression that evaluates to a numeric type. If the expression cannot be converted to a numeric type, the $median calculation ignores it. */
    public readonly Decimal128|Int64|PackedArray|ResolvesToNumber|BSONArray|array|float|int $input;

    /** @var non-empty-string $method The method that mongod uses to calculate the 50th percentile value. The method must be 'approximate'. */
    public readonly string $method;

    /**
     * @param BSONArray|Decimal128|Int64|PackedArray|ResolvesToNumber|array|float|int $input $median calculates the 50th percentile value of this data. input must be a field name or an expression that evaluates to a numeric type. If the expression cannot be converted to a numeric type, the $median calculation ignores it.
     * @param non-empty-string $method The method that mongod uses to calculate the 50th percentile value. The method must be 'approximate'.
     */
    public function __construct(
        Decimal128|Int64|PackedArray|ResolvesToNumber|BSONArray|array|float|int $input,
        string $method,
    ) {
        if (is_array($input) && ! array_is_list($input)) {
            throw new InvalidArgumentException('Expected $input argument to be a list, got an associative array.');
        }

        $this->input = $input;
        $this->method = $method;
    }

    public function getOperator(): string
    {
        return '$median';
    }
}
