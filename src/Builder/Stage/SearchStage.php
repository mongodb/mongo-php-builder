<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Stage;

use MongoDB\BSON\Document;
use MongoDB\BSON\Serializable;
use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\StageInterface;
use stdClass;

/**
 * Performs a full-text search of the field or fields in an Atlas collection.
 * NOTE: $search is only available for MongoDB Atlas clusters, and is not available for self-managed deployments.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/search/
 */
readonly class SearchStage implements StageInterface
{
    public const NAME = '$search';
    public const ENCODE = Encode::Single;

    /** @param Document|Serializable|array|stdClass $search */
    public Document|Serializable|stdClass|array $search;

    /**
     * @param Document|Serializable|array|stdClass $search
     */
    public function __construct(Document|Serializable|stdClass|array $search)
    {
        $this->search = $search;
    }
}
