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

/**
 * Returns a set with elements that appear in any of the input sets.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/setUnion/
 */
readonly class SetUnionOperator implements ResolvesToArray
{
    public const NAME = '$setUnion';
    public const ENCODE = Encode::Single;

    /** @param list<BSONArray|PackedArray|ResolvesToArray|array> ...$expression */
    public array $expression;

    /**
     * @param BSONArray|PackedArray|ResolvesToArray|array ...$expression
     * @no-named-arguments
     */
    public function __construct(PackedArray|ResolvesToArray|BSONArray|array ...$expression)
    {
        if (\count($expression) < 1) {
            throw new \InvalidArgumentException(\sprintf('Expected at least %d values for $expression, got %d.', 1, \count($expression)));
        }
        if (! array_is_list($expression)) {
            throw new InvalidArgumentException('Expected $expression arguments to be a list (array), named arguments are not supported');
        }
        $this->expression = $expression;
    }
}
