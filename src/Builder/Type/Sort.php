<?php

declare(strict_types=1);

namespace MongoDB\Builder\Type;

/**
 * Sort order can be used with $sort stage and sortBy properties
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/sort/
 */
enum Sort implements DictionaryInterface
{
    case Asc;
    case Desc;
    case TextScore;
    case SearchScoreAsc;
    case SearchScoreDesc;

    public function getValue(): int|array
    {
        return match ($this) {
            self::Asc => 1,
            self::Desc => -1,
            self::TextScore => ['$meta' => 'textScore'],
            self::SearchScoreAsc => ['$meta' => 'searchScore', 'order' => 1],
            self::SearchScoreDesc => ['$meta' => 'searchScore', 'order' => -1],
        };
    }
}
