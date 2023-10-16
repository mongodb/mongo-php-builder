<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Expression;

use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\Optional;

/**
 * Searches a string for an occurrence of a substring and returns the UTF-8 byte index of the first occurrence. If the substring is not found, returns -1.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/indexOfBytes/
 */
class IndexOfBytesOperator implements ResolvesToInt
{
    public const NAME = '$indexOfBytes';
    public const ENCODE = Encode::Array;

    /**
     * @var ResolvesToString|non-empty-string $string Can be any valid expression as long as it resolves to a string.
     * If the string expression resolves to a value of null or refers to a field that is missing, $indexOfBytes returns null.
     * If the string expression does not resolve to a string or null nor refers to a missing field, $indexOfBytes returns an error.
     */
    public readonly ResolvesToString|string $string;

    /** @var ResolvesToString|non-empty-string $substring Can be any valid expression as long as it resolves to a string. */
    public readonly ResolvesToString|string $substring;

    /**
     * @var Optional|ResolvesToInt|int $start An integer, or a number that can be represented as integers (such as 2.0), that specifies the starting index position for the search. Can be any valid expression that resolves to a non-negative integral number.
     * If unspecified, the starting index position for the search is the beginning of the string.
     */
    public readonly Optional|ResolvesToInt|int $start;

    /**
     * @var Optional|ResolvesToInt|int $end An integer, or a number that can be represented as integers (such as 2.0), that specifies the ending index position for the search. Can be any valid expression that resolves to a non-negative integral number. If you specify a <end> index value, you should also specify a <start> index value; otherwise, $indexOfArray uses the <end> value as the <start> index value instead of the <end> value.
     * If unspecified, the ending index position for the search is the end of the string.
     */
    public readonly Optional|ResolvesToInt|int $end;

    /**
     * @param ResolvesToString|non-empty-string $string Can be any valid expression as long as it resolves to a string.
     * If the string expression resolves to a value of null or refers to a field that is missing, $indexOfBytes returns null.
     * If the string expression does not resolve to a string or null nor refers to a missing field, $indexOfBytes returns an error.
     * @param ResolvesToString|non-empty-string $substring Can be any valid expression as long as it resolves to a string.
     * @param Optional|ResolvesToInt|int $start An integer, or a number that can be represented as integers (such as 2.0), that specifies the starting index position for the search. Can be any valid expression that resolves to a non-negative integral number.
     * If unspecified, the starting index position for the search is the beginning of the string.
     * @param Optional|ResolvesToInt|int $end An integer, or a number that can be represented as integers (such as 2.0), that specifies the ending index position for the search. Can be any valid expression that resolves to a non-negative integral number. If you specify a <end> index value, you should also specify a <start> index value; otherwise, $indexOfArray uses the <end> value as the <start> index value instead of the <end> value.
     * If unspecified, the ending index position for the search is the end of the string.
     */
    public function __construct(
        ResolvesToString|string $string,
        ResolvesToString|string $substring,
        Optional|ResolvesToInt|int $start = Optional::Undefined,
        Optional|ResolvesToInt|int $end = Optional::Undefined,
    ) {
        $this->string = $string;
        $this->substring = $substring;
        $this->start = $start;
        $this->end = $end;
    }
}
