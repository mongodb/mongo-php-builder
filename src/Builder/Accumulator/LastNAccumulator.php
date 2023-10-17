<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Accumulator;

use MongoDB\BSON\PackedArray;
use MongoDB\Builder\Expression\ResolvesToArray;
use MongoDB\Builder\Expression\ResolvesToInt;
use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\OperatorInterface;
use MongoDB\Builder\Type\WindowInterface;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Model\BSONArray;

use function array_is_list;
use function is_array;

/**
 * Returns a specified number of elements from the end of an array. Distinct from the $lastN accumulator.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/lastN/
 */
class LastNAccumulator implements WindowInterface, OperatorInterface
{
    public const ENCODE = Encode::Object;

    /** @var BSONArray|PackedArray|ResolvesToArray|array $input An expression that resolves to the array from which to return n elements. */
    public readonly PackedArray|ResolvesToArray|BSONArray|array $input;

    /** @var ResolvesToInt|int $n An expression that resolves to a positive integer. The integer specifies the number of array elements that $firstN returns. */
    public readonly ResolvesToInt|int $n;

    /**
     * @param BSONArray|PackedArray|ResolvesToArray|array $input An expression that resolves to the array from which to return n elements.
     * @param ResolvesToInt|int $n An expression that resolves to a positive integer. The integer specifies the number of array elements that $firstN returns.
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
        return '$lastN';
    }
}
