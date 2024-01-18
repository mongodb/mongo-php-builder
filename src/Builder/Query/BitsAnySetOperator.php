<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Query;

use MongoDB\BSON\Binary;
use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\FieldQueryInterface;
use MongoDB\Builder\Type\OperatorInterface;
use MongoDB\Exception\InvalidArgumentException;

use function array_is_list;

/**
 * Matches numeric or binary values in which any bit from a set of bit positions has a value of 1.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/query/bitsAnySet/
 */
class BitsAnySetOperator implements FieldQueryInterface, OperatorInterface
{
    public const ENCODE = Encode::Single;

    /** @var list<Binary|int|non-empty-string> $bitmask */
    public readonly array $bitmask;

    /**
     * @param Binary|int|non-empty-string ...$bitmask
     * @no-named-arguments
     */
    public function __construct(Binary|int|string ...$bitmask)
    {
        if (\count($bitmask) < 1) {
            throw new \InvalidArgumentException(\sprintf('Expected at least %d values for $bitmask, got %d.', 1, \count($bitmask)));
        }

        if (! array_is_list($bitmask)) {
            throw new InvalidArgumentException('Expected $bitmask arguments to be a list (array), named arguments are not supported');
        }

        $this->bitmask = $bitmask;
    }

    public function getOperator(): string
    {
        return '$bitsAnySet';
    }
}
