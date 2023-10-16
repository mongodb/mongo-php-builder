<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Query;

use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\FieldQueryInterface;

/**
 * Matches documents that have the specified field.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/query/exists/
 */
readonly class ExistsOperator implements FieldQueryInterface
{
    public const NAME = '$exists';
    public const ENCODE = Encode::Single;

    /** @param bool $exists */
    public bool $exists;

    /**
     * @param bool $exists
     */
    public function __construct(bool $exists)
    {
        $this->exists = $exists;
    }
}
