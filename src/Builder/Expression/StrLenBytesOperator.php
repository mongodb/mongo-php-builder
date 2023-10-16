<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Expression;

use MongoDB\Builder\Type\Encode;

/**
 * Returns the number of UTF-8 encoded bytes in a string.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/strLenBytes/
 */
readonly class StrLenBytesOperator implements ResolvesToInt
{
    public const NAME = '$strLenBytes';
    public const ENCODE = Encode::Single;

    /** @param ResolvesToString|non-empty-string $expression */
    public ResolvesToString|string $expression;

    /**
     * @param ResolvesToString|non-empty-string $expression
     */
    public function __construct(ResolvesToString|string $expression)
    {
        $this->expression = $expression;
    }
}
