<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Stage;

use MongoDB\BSON\Document;
use MongoDB\BSON\Serializable;
use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\OperatorInterface;
use MongoDB\Builder\Type\Optional;
use MongoDB\Builder\Type\StageInterface;
use MongoDB\Exception\InvalidArgumentException;
use stdClass;

use function is_string;

/**
 * Performs a full-text search of the field or fields in an Atlas collection.
 * NOTE: $search is only available for MongoDB Atlas clusters, and is not available for self-managed deployments.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/search/
 */
class SearchStage implements StageInterface, OperatorInterface
{
    public const ENCODE = Encode::Object;

    /** @var stdClass<Document|Serializable|array|stdClass> $operatorOrCollection */
    public readonly stdClass $operatorOrCollection;

    /** @var Optional|string $index */
    public readonly Optional|string $index;

    /** @var Optional|Document|Serializable|array|stdClass $highlight */
    public readonly Optional|Document|Serializable|stdClass|array $highlight;

    /** @var Optional|bool $concurrent */
    public readonly Optional|bool $concurrent;

    /** @var Optional|Document|Serializable|array|stdClass $count */
    public readonly Optional|Document|Serializable|stdClass|array $count;

    /** @var Optional|string $searchAfter */
    public readonly Optional|string $searchAfter;

    /** @var Optional|string $searchBefore */
    public readonly Optional|string $searchBefore;

    /** @var Optional|bool $scoreDetails */
    public readonly Optional|bool $scoreDetails;

    /** @var Optional|Document|Serializable|array|stdClass $sort */
    public readonly Optional|Document|Serializable|stdClass|array $sort;

    /** @var Optional|bool $returnStoredSource */
    public readonly Optional|bool $returnStoredSource;

    /** @var Optional|Document|Serializable|array|stdClass $tracking */
    public readonly Optional|Document|Serializable|stdClass|array $tracking;

    /**
     * @param Document|Serializable|array|stdClass ...$operatorOrCollection
     * @param Optional|string $index
     * @param Optional|Document|Serializable|array|stdClass $highlight
     * @param Optional|bool $concurrent
     * @param Optional|Document|Serializable|array|stdClass $count
     * @param Optional|string $searchAfter
     * @param Optional|string $searchBefore
     * @param Optional|bool $scoreDetails
     * @param Optional|Document|Serializable|array|stdClass $sort
     * @param Optional|bool $returnStoredSource
     * @param Optional|Document|Serializable|array|stdClass $tracking
     */
    public function __construct(
        Document|Serializable|stdClass|array $operatorOrCollection,
        Optional|string $index = Optional::Undefined,
        Optional|Document|Serializable|stdClass|array $highlight = Optional::Undefined,
        Optional|bool $concurrent = Optional::Undefined,
        Optional|Document|Serializable|stdClass|array $count = Optional::Undefined,
        Optional|string $searchAfter = Optional::Undefined,
        Optional|string $searchBefore = Optional::Undefined,
        Optional|bool $scoreDetails = Optional::Undefined,
        Optional|Document|Serializable|stdClass|array $sort = Optional::Undefined,
        Optional|bool $returnStoredSource = Optional::Undefined,
        Optional|Document|Serializable|stdClass|array ...$tracking,
    ) {
        if (\count($operatorOrCollection) < 1) {
            throw new \InvalidArgumentException(\sprintf('Expected at least %d values for $operatorOrCollection, got %d.', 1, \count($operatorOrCollection)));
        }

        foreach($operatorOrCollection as $key => $value) {
            if (! is_string($key)) {
                throw new InvalidArgumentException('Expected $operatorOrCollection arguments to be a map (object), named arguments (<name>:<value>) or array unpacking ...[\'<name>\' => <value>] must be used');
            }
        }

        $operatorOrCollection = (object) $operatorOrCollection;
        $this->operatorOrCollection = $operatorOrCollection;
        $this->index = $index;
        $this->highlight = $highlight;
        $this->concurrent = $concurrent;
        $this->count = $count;
        $this->searchAfter = $searchAfter;
        $this->searchBefore = $searchBefore;
        $this->scoreDetails = $scoreDetails;
        $this->sort = $sort;
        $this->returnStoredSource = $returnStoredSource;
        $this->tracking = $tracking;
    }

    public function getOperator(): string
    {
        return '$search';
    }
}
