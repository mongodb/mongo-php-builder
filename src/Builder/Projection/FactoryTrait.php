<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Projection;

use MongoDB\Builder\Type\Optional;
use MongoDB\Builder\Type\QueryInterface;

/**
 * @internal
 */
trait FactoryTrait
{
    /**
     * Projects the first element in an array that matches the specified $elemMatch condition.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/projection/elemMatch/
     * @param QueryInterface|array $query
     */
    public static function elemMatch(QueryInterface|array $query): ElemMatchOperator
    {
        return new ElemMatchOperator($query);
    }

    /**
     * Limits the number of elements projected from an array. Supports skip and limit slices.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/projection/slice/
     * @param int $limit
     * @param Optional|int $skip
     */
    public static function slice(int $limit, Optional|int $skip = Optional::Undefined): SliceOperator
    {
        return new SliceOperator($limit, $skip);
    }
}
