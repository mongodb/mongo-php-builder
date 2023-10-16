<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Expression;

use MongoDB\BSON\PackedArray;
use MongoDB\Builder\Type\Encode;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Model\BSONArray;

use function array_is_list;
use function is_array;

/**
 * Returns the number of elements in the array. Accepts a single expression as argument.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/size/
 */
class SizeOperator implements ResolvesToInt
{
    public const NAME = '$size';
    public const ENCODE = Encode::Single;

    /** @var BSONArray|PackedArray|ResolvesToArray|array $expression The argument for $size can be any expression as long as it resolves to an array. */
    public readonly PackedArray|ResolvesToArray|BSONArray|array $expression;

    /**
     * @param BSONArray|PackedArray|ResolvesToArray|array $expression The argument for $size can be any expression as long as it resolves to an array.
     */
    public function __construct(PackedArray|ResolvesToArray|BSONArray|array $expression)
    {
        if (is_array($expression) && ! array_is_list($expression)) {
            throw new InvalidArgumentException('Expected $expression argument to be a list, got an associative array.');
        }

        $this->expression = $expression;
    }
}
