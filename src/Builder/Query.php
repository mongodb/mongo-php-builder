<?php

declare(strict_types=1);

namespace MongoDB\Builder;

use MongoDB\BSON\Regex;
use MongoDB\BSON\Type;
use MongoDB\Builder\Query\RegexOperator;
use MongoDB\Builder\Query\TypeOperator;
use MongoDB\Builder\Type\CombinedFieldQuery;
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
final class Query
{
    use Query\FactoryTrait {
        regex as private generatedRegex;
        type as private generatedType;
    }

    /**
     * Selects documents if a field is of the specified type.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/type/
     *
     * @param int|non-empty-string|QueryType ...$type
     *
     * @no-named-arguments
     */
    public static function type(string|int|QueryType ...$type): TypeOperator
    {
        foreach ($type as &$value) {
            if ($value instanceof QueryType) {
                $value = $value->value;
            }
        }

        return self::generatedType(...$type);
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
     * Combine multiple field query operators that apply to a same field.
     */
    public static function fieldQuery(FieldQueryInterface|Type|stdClass|array|bool|float|int|string|null ...$query): FieldQueryInterface
    {
        return new CombinedFieldQuery($query);
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
