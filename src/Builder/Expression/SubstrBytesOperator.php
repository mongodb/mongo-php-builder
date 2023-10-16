<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Expression;

use MongoDB\Builder\Type\Encode;

/**
 * Returns the substring of a string. Starts with the character at the specified UTF-8 byte index (zero-based) in the string and continues for the specified number of bytes.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/substrBytes/
 */
class SubstrBytesOperator implements ResolvesToString
{
    public const NAME = '$substrBytes';
    public const ENCODE = Encode::Array;

    /** @var ResolvesToString|non-empty-string $string */
    public readonly ResolvesToString|string $string;

    /** @var ResolvesToInt|int $start If start is a negative number, $substr returns an empty string "". */
    public readonly ResolvesToInt|int $start;

    /** @var ResolvesToInt|int $length If length is a negative number, $substr returns a substring that starts at the specified index and includes the rest of the string. */
    public readonly ResolvesToInt|int $length;

    /**
     * @param ResolvesToString|non-empty-string $string
     * @param ResolvesToInt|int $start If start is a negative number, $substr returns an empty string "".
     * @param ResolvesToInt|int $length If length is a negative number, $substr returns a substring that starts at the specified index and includes the rest of the string.
     */
    public function __construct(ResolvesToString|string $string, ResolvesToInt|int $start, ResolvesToInt|int $length)
    {
        $this->string = $string;
        $this->start = $start;
        $this->length = $length;
    }
}
