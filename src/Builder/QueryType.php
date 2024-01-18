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

    case Double = 'double';
    case String = 'string';
    case Object = 'object';
    case Array = 'array';
    case BinaryData = 'binData';
    case ObjectId = 'objectId';
    case Boolean = 'bool';
    case Date = 'date';
    case Null = 'null';
    case Regex = 'regex';
    case JavaScript = 'javascript';
    case Int = 'int';
    case Timestamp = 'timestamp';
    case Long = 'long';
    case Decimal128 = 'decimal';
    case MinKey = 'minKey';
    case MaxKey = 'maxKey';
    /**
     * Alias for Double, Int, Long, Decimal
     */
    case Number = 'number';

    public function getOperator(): string
    {
        return '$type';
    }
}
