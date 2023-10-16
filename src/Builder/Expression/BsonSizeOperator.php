<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Expression;

use MongoDB\BSON\Document;
use MongoDB\BSON\Serializable;
use MongoDB\Builder\Type\Encode;
use stdClass;

/**
 * Returns the size in bytes of a given document (i.e. bsontype Object) when encoded as BSON.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/bsonSize/
 */
class BsonSizeOperator implements ResolvesToInt
{
    public const NAME = '$bsonSize';
    public const ENCODE = Encode::Single;

    /** @var Document|ResolvesToNull|ResolvesToObject|Serializable|array|null|stdClass $object */
    public readonly Document|Serializable|ResolvesToNull|ResolvesToObject|stdClass|array|null $object;

    /**
     * @param Document|ResolvesToNull|ResolvesToObject|Serializable|array|null|stdClass $object
     */
    public function __construct(Document|Serializable|ResolvesToNull|ResolvesToObject|stdClass|array|null $object)
    {
        $this->object = $object;
    }
}
