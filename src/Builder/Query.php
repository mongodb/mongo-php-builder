<?php

declare(strict_types=1);

namespace MongoDB\Builder;

use MongoDB\BSON\Regex;
use MongoDB\BSON\Type;
use MongoDB\Builder\Query\ElemMatchOperator;
use MongoDB\Builder\Query\RegexOperator;
use MongoDB\Builder\Type\CombinedFieldQuery;
use MongoDB\Builder\Type\FieldQueryInterface;
use MongoDB\Builder\Type\QueryInterface;
use MongoDB\Builder\Type\QueryObject;
use MongoDB\Exception\InvalidArgumentException;
use stdClass;

use function array_is_list;
use function is_string;

/**
 * Factories for Query Operators
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/query/
 */
final class Query
{
    use Query\FactoryTrait {
        regex as private generatedRegex;
        elemMatch as private generatedElemMatch;
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

    /**
     * The $elemMatch operator matches documents that contain an array field with at least one element that matches all the specified query criteria.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/elemMatch/
     */
    public static function elemMatch(QueryInterface|FieldQueryInterface|Type|stdClass|array|bool|float|int|string|null ...$query): ElemMatchOperator
    {
        // $elemMatch accepts field query without field name ...
        if (array_is_list($query) && isset($query[0]) && ! $query[0] instanceof QueryInterface) {
            return self::generatedElemMatch(new CombinedFieldQuery($query));
        }

        // ... or a query
        return self::generatedElemMatch(QueryObject::create($query));
    }

    public static function query(QueryInterface|FieldQueryInterface|Type|stdClass|array|bool|float|int|string|null ...$query): QueryInterface
    {
        return QueryObject::create($query);
    }

    private function __construct()
    {
        // This class cannot be instantiated
    }
}
