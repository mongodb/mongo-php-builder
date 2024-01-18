<?php

declare(strict_types=1);

namespace MongoDB\Builder;

use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\ExpressionInterface;
use MongoDB\Builder\Type\OperatorInterface;

/**
 * Returns the metadata associated with a document, e.g. "textScore" when performing text search.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/meta/
 */
enum Meta: string implements OperatorInterface, ExpressionInterface
{
    public const ENCODE = Encode::Single;

    /**
     * Returns the score associated with the corresponding $text query for each
     * matching document. The text score signifies how well the document matched
     * the search term or terms.
     */
    case TextScore = 'textScore';

    /**
     * Returns an index key for the document if a non-text index is used. The
     * { $meta: "indexKey" } expression is for debugging purposes only, and
     * not for application logic, and is preferred over cursor.returnKey().
     */
    case IndexKey = 'indexKey';

    public function getOperator(): string
    {
        return '$meta';
    }
}
