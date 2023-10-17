<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Expression;

use MongoDB\BSON\PackedArray;
use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\OperatorInterface;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Model\BSONArray;

use function array_is_list;
use function is_array;

/**
 * Returns the n smallest values in an array. Distinct from the $minN accumulator.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/minN-array-element/
 */
class MinNOperator implements ResolvesToArray, OperatorInterface
{
    public const ENCODE = Encode::Object;

    /** @var BSONArray|PackedArray|ResolvesToArray|array $input An expression that resolves to the array from which to return the maximal n elements. */
    public readonly PackedArray|ResolvesToArray|BSONArray|array $input;

    /** @var ResolvesToInt|int $n An expression that resolves to a positive integer. The integer specifies the number of array elements that $maxN returns. */
    public readonly ResolvesToInt|int $n;

    /**
     * @param BSONArray|PackedArray|ResolvesToArray|array $input An expression that resolves to the array from which to return the maximal n elements.
     * @param ResolvesToInt|int $n An expression that resolves to a positive integer. The integer specifies the number of array elements that $maxN returns.
     */
    public function __construct(PackedArray|ResolvesToArray|BSONArray|array $input, ResolvesToInt|int $n)
    {
        if (is_array($input) && ! array_is_list($input)) {
            throw new InvalidArgumentException('Expected $input argument to be a list, got an associative array.');
        }

        $this->input = $input;
        $this->n = $n;
    }

    public function getOperator(): string
    {
        return '$minN';
    }
}
