<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Expression;

use MongoDB\Builder\Type\Encode;

/**
 * Access available per-document metadata related to the aggregation operation.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/meta/
 */
class MetaOperator implements ResolvesToAny
{
    public const NAME = '$meta';
    public const ENCODE = Encode::Single;

    /** @var non-empty-string $keyword */
    public readonly string $keyword;

    /**
     * @param non-empty-string $keyword
     */
    public function __construct(string $keyword)
    {
        $this->keyword = $keyword;
    }
}
