<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Accumulator;

use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\WindowInterface;

/**
 * Returns the document position (known as the rank) relative to other documents in the $setWindowFields stage partition. There are no gaps in the ranks. Ties receive the same rank.
 * New in version 5.0.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/denseRank/
 */
readonly class DenseRankAccumulator implements WindowInterface
{
    public const NAME = '$denseRank';
    public const ENCODE = Encode::Object;

    public function __construct()
    {
    }
}
