<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Expression;

use MongoDB\BSON\Type;
use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\ExpressionInterface;
use MongoDB\Builder\Type\Optional;
use stdClass;

/**
 * Searches an array for an occurrence of a specified value and returns the array index of the first occurrence. Array indexes start at zero.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/indexOfArray/
 */
readonly class IndexOfArrayOperator implements ResolvesToInt
{
    public const NAME = '$indexOfArray';
    public const ENCODE = Encode::Array;

    /**
     * @param ResolvesToString|non-empty-string $array Can be any valid expression as long as it resolves to an array.
     * If the array expression resolves to a value of null or refers to a field that is missing, $indexOfArray returns null.
     * If the array expression does not resolve to an array or null nor refers to a missing field, $indexOfArray returns an error.
     */
    public ResolvesToString|string $array;

    /** @param ExpressionInterface|Type|array|bool|float|int|non-empty-string|null|stdClass $search */
    public Type|ExpressionInterface|stdClass|array|bool|float|int|null|string $search;

    /**
     * @param Optional|ResolvesToInt|int $start An integer, or a number that can be represented as integers (such as 2.0), that specifies the starting index position for the search. Can be any valid expression that resolves to a non-negative integral number.
     * If unspecified, the starting index position for the search is the beginning of the string.
     */
    public Optional|ResolvesToInt|int $start;

    /**
     * @param Optional|ResolvesToInt|int $end An integer, or a number that can be represented as integers (such as 2.0), that specifies the ending index position for the search. Can be any valid expression that resolves to a non-negative integral number. If you specify a <end> index value, you should also specify a <start> index value; otherwise, $indexOfArray uses the <end> value as the <start> index value instead of the <end> value.
     * If unspecified, the ending index position for the search is the end of the string.
     */
    public Optional|ResolvesToInt|int $end;

    /**
     * @param ResolvesToString|non-empty-string $array Can be any valid expression as long as it resolves to an array.
     * If the array expression resolves to a value of null or refers to a field that is missing, $indexOfArray returns null.
     * If the array expression does not resolve to an array or null nor refers to a missing field, $indexOfArray returns an error.
     * @param ExpressionInterface|Type|array|bool|float|int|non-empty-string|null|stdClass $search
     * @param Optional|ResolvesToInt|int $start An integer, or a number that can be represented as integers (such as 2.0), that specifies the starting index position for the search. Can be any valid expression that resolves to a non-negative integral number.
     * If unspecified, the starting index position for the search is the beginning of the string.
     * @param Optional|ResolvesToInt|int $end An integer, or a number that can be represented as integers (such as 2.0), that specifies the ending index position for the search. Can be any valid expression that resolves to a non-negative integral number. If you specify a <end> index value, you should also specify a <start> index value; otherwise, $indexOfArray uses the <end> value as the <start> index value instead of the <end> value.
     * If unspecified, the ending index position for the search is the end of the string.
     */
    public function __construct(
        ResolvesToString|string $array,
        Type|ExpressionInterface|stdClass|array|bool|float|int|null|string $search,
        Optional|ResolvesToInt|int $start = Optional::Undefined,
        Optional|ResolvesToInt|int $end = Optional::Undefined,
    ) {
        $this->array = $array;
        $this->search = $search;
        $this->start = $start;
        $this->end = $end;
    }
}
