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
 * Returns an array of scalar values that correspond to specified percentile values.
 * New in MongoDB 7.0.
 *
 * This operator is available as an accumulator in these stages:
 * $group
 *
 * $setWindowFields
 *
 * It is also available as an aggregation expression.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/percentile/
 */
class PercentileOperator implements ResolvesToArray, OperatorInterface
{
    public const ENCODE = Encode::Object;

    /** @var BSONArray|Decimal128|Int64|PackedArray|ResolvesToNumber|array|float|int $input $percentile calculates the percentile values of this data. input must be a field name or an expression that evaluates to a numeric type. If the expression cannot be converted to a numeric type, the $percentile calculation ignores it. */
    public readonly Decimal128|Int64|PackedArray|ResolvesToNumber|BSONArray|array|float|int $input;

    /**
     * @var BSONArray|PackedArray|ResolvesToArray|array $p $percentile calculates a percentile value for each element in p. The elements represent percentages and must evaluate to numeric values in the range 0.0 to 1.0, inclusive.
     * $percentile returns results in the same order as the elements in p.
     */
    public readonly PackedArray|ResolvesToArray|BSONArray|array $p;

    /** @var non-empty-string $method The method that mongod uses to calculate the percentile value. The method must be 'approximate'. */
    public readonly string $method;

    /**
     * @param BSONArray|Decimal128|Int64|PackedArray|ResolvesToNumber|array|float|int $input $percentile calculates the percentile values of this data. input must be a field name or an expression that evaluates to a numeric type. If the expression cannot be converted to a numeric type, the $percentile calculation ignores it.
     * @param BSONArray|PackedArray|ResolvesToArray|array $p $percentile calculates a percentile value for each element in p. The elements represent percentages and must evaluate to numeric values in the range 0.0 to 1.0, inclusive.
     * $percentile returns results in the same order as the elements in p.
     * @param non-empty-string $method The method that mongod uses to calculate the percentile value. The method must be 'approximate'.
     */
    public function __construct(
        Decimal128|Int64|PackedArray|ResolvesToNumber|BSONArray|array|float|int $input,
        PackedArray|ResolvesToArray|BSONArray|array $p,
        string $method,
    ) {
        if (is_array($input) && ! array_is_list($input)) {
            throw new InvalidArgumentException('Expected $input argument to be a list, got an associative array.');
        }

        $this->input = $input;
        if (is_array($p) && ! array_is_list($p)) {
            throw new InvalidArgumentException('Expected $p argument to be a list, got an associative array.');
        }

        $this->p = $p;
        $this->method = $method;
    }

    public function getOperator(): string
    {
        return '$percentile';
    }
}
