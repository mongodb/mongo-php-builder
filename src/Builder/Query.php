<?php

declare(strict_types=1);

namespace MongoDB\Builder;

use MongoDB\BSON\Regex;
use MongoDB\BSON\Serializable;
use MongoDB\Builder\Query\RegexOperator;
use MongoDB\Builder\Type\FieldQueryInterface;
use MongoDB\Builder\Type\QueryInterface;
use MongoDB\Builder\Type\QueryObject;
use MongoDB\Exception\InvalidArgumentException;
use stdClass;

use function is_string;

/**
 * Factories for Query Operators
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/query/
 */
enum Query
{
    use Query\FactoryTrait {
        regex as private generatedRegex;
    }

    /**
     * Selects documents where values match a specified regular expression.
     */
    public static function regex(Regex|string $regex, string|null $flags = null): RegexOperator
    {
        if (is_string($regex)) {
            $regex = new Regex($regex, $flags ?? '');
        } elseif (is_string($flags)) {
            throw new InvalidArgumentException('Regex flags must be specified as part of the Regex object');
        }

        return self::generatedRegex($regex);
    }

    public static function query(FieldQueryInterface|QueryInterface|Serializable|array|bool|float|int|stdClass|string|null ...$query): QueryInterface
    {
        return QueryObject::create($query);
    }
}
