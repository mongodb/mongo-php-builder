<?php

declare(strict_types=1);

namespace MongoDB\Builder\Type;

enum Sort implements Dictionnary
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
