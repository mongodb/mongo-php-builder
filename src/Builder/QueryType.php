<?php

declare(strict_types=1);

namespace MongoDB\Builder;

use MongoDB\Builder\Query\TypeOperator;
use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\FieldQueryInterface;
use MongoDB\Builder\Type\OperatorInterface;

/**
 * Shortcut for $type field query operator
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/query/type/#available-types
 * @see TypeOperator
 */
enum QueryType: string implements OperatorInterface, FieldQueryInterface
{
    public const ENCODE = Encode::Array;

    case Array = 'array';
    case Binary = 'binData';
    case Bool = 'bool';
    case Decimal64 = 'double';
    case Decimal128 = 'decimal';
    case Int32 = 'int';
    case Int64 = 'long';
    case Javascript = 'javascript';
    case Object = 'object';
    case ObjectId = 'objectId';
    case MaxKey = 'maxKey';
    case MinKey = 'minKey';
    case Null = 'null';
    /** Alias for Int32, Int64, Decimal64, Decimal128 */
    case Number = 'number';
    case Regex = 'regex';
    case String = 'string';
    case Timestamp = 'timestamp';
    case UTCDateTime = 'date';

    public function getOperator(): string
    {
        return '$type';
    }
}
