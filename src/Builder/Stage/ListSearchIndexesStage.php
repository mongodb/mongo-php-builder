<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Stage;

use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\Optional;
use MongoDB\Builder\Type\StageInterface;

/**
 * Returns information about existing Atlas Search indexes on a specified collection.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/listSearchIndexes/
 */
readonly class ListSearchIndexesStage implements StageInterface
{
    public const NAME = '$listSearchIndexes';
    public const ENCODE = Encode::Object;

    /** @param Optional|non-empty-string $id The id of the index to return information about. */
    public Optional|string $id;

    /** @param Optional|non-empty-string $name The name of the index to return information about. */
    public Optional|string $name;

    /**
     * @param Optional|non-empty-string $id The id of the index to return information about.
     * @param Optional|non-empty-string $name The name of the index to return information about.
     */
    public function __construct(
        Optional|string $id = Optional::Undefined,
        Optional|string $name = Optional::Undefined,
    ) {
        $this->id = $id;
        $this->name = $name;
    }
}
