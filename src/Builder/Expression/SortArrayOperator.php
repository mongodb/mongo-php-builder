<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Expression;

use MongoDB\BSON\Document;
use MongoDB\BSON\PackedArray;
use MongoDB\BSON\Serializable;
use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\OperatorInterface;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Model\BSONArray;
use stdClass;

use function array_is_list;
use function is_array;

/**
 * Sorts the elements of an array.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/sortArray/
 */
class SortArrayOperator implements ResolvesToArray, OperatorInterface
{
    public const ENCODE = Encode::Object;

    /**
     * @var BSONArray|PackedArray|ResolvesToArray|array $input The array to be sorted.
     * The result is null if the expression: is missing, evaluates to null, or evaluates to undefined
     * If the expression evaluates to any other non-array value, the document returns an error.
     */
    public readonly PackedArray|ResolvesToArray|BSONArray|array $input;

    /** @var Document|Serializable|array|int|stdClass $sortBy The document specifies a sort ordering. */
    public readonly Document|Serializable|stdClass|array|int $sortBy;

    /**
     * @param BSONArray|PackedArray|ResolvesToArray|array $input The array to be sorted.
     * The result is null if the expression: is missing, evaluates to null, or evaluates to undefined
     * If the expression evaluates to any other non-array value, the document returns an error.
     * @param Document|Serializable|array|int|stdClass $sortBy The document specifies a sort ordering.
     */
    public function __construct(
        PackedArray|ResolvesToArray|BSONArray|array $input,
        Document|Serializable|stdClass|array|int $sortBy,
    ) {
        if (is_array($input) && ! array_is_list($input)) {
            throw new InvalidArgumentException('Expected $input argument to be a list, got an associative array.');
        }

        $this->input = $input;
        $this->sortBy = $sortBy;
    }

    public function getOperator(): string
    {
        return '$sortArray';
    }
}
