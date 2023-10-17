<?php

declare(strict_types=1);

namespace MongoDB\Builder\Type;

use MongoDB\BSON\Document;
use MongoDB\BSON\Regex;
use MongoDB\BSON\Serializable;
use MongoDB\Exception\InvalidArgumentException;
use stdClass;

use function array_is_list;
use function count;
use function is_array;
use function sprintf;

/**
 * Helper class to validate query objects.
 *
 * Queries are a mix of query operators ($or, $and, $nor...) and field query operators ($eq, $gt, $in...) associated to a field path.
 */
final class QueryObject implements QueryInterface
{
    public readonly array $queries;

    public static function create(QueryInterface|FieldQueryInterface|array|stdClass|string|int|float|bool|Regex|Document|null ...$queries): QueryInterface
    {
        // We don't wrap a single query in a QueryObject
        if (count($queries) === 1 && isset($queries[0]) && $queries[0] instanceof QueryInterface) {
            return $queries[0];
        }

        return new self($queries);
    }

    private function __construct(
        Serializable|array|stdClass $queriesOrArrayOfQueries,
    ) {
        $seenQueryOperators = [];
        $queries = [];
        foreach ($queriesOrArrayOfQueries as $fieldPath => $query) {
            if ($query instanceof QueryInterface) {
                if ($query instanceof OperatorInterface) {
                    if (isset($seenQueryOperators[$query->getOperator()])) {
                        throw new InvalidArgumentException(sprintf('Query operator "%s" cannot be used multiple times in the same query.', $query->getOperator()));
                    }

                    $seenQueryOperators[$query->getOperator()] = true;
                }

                $queries[] = $query;
                continue;
            }

            // Convert list of filters into $and
            if (self::isListOfFilters($query)) {
                if (count($query) === 1) {
                    $query = $query[0];
                } else {
                    $query = new CombinedFieldQuery($query);
                }
            }

            // Numbers are valid field paths, nothing to validate.
            $queries[$fieldPath] = $query;
        }

        $this->queries = $queries;
    }

    private static function isListOfFilters(mixed $values): bool
    {
        if (! is_array($values) || ! array_is_list($values)) {
            return false;
        }

        foreach ($values as $value) {
            if ($value instanceof FieldQueryInterface) {
                return true;
            }
        }

        return false;
    }
}
