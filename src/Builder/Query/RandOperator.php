<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Query;

use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\ExpressionInterface;

/**
 * Generates a random float between 0 and 1.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/query/rand/
 */
class RandOperator implements ExpressionInterface
{
    public const NAME = '$rand';
    public const ENCODE = Encode::Object;

    public function __construct()
    {
    }
}
