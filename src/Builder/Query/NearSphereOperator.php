<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Query;

use MongoDB\BSON\Document;
use MongoDB\BSON\Serializable;
use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\FieldQueryInterface;
use MongoDB\Builder\Type\GeometryInterface;
use MongoDB\Builder\Type\Optional;
use stdClass;

/**
 * Returns geospatial objects in proximity to a point on a sphere. Requires a geospatial index. The 2dsphere and 2d indexes support $nearSphere.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/query/nearSphere/
 */
readonly class NearSphereOperator implements FieldQueryInterface
{
    public const NAME = '$nearSphere';
    public const ENCODE = Encode::Object;

    /** @param Document|GeometryInterface|Serializable|array|stdClass $geometry */
    public Document|Serializable|GeometryInterface|stdClass|array $geometry;

    /** @param Optional|int $maxDistance Distance in meters. */
    public Optional|int $maxDistance;

    /** @param Optional|int $minDistance Distance in meters. Limits the results to those documents that are at least the specified distance from the center point. */
    public Optional|int $minDistance;

    /**
     * @param Document|GeometryInterface|Serializable|array|stdClass $geometry
     * @param Optional|int $maxDistance Distance in meters.
     * @param Optional|int $minDistance Distance in meters. Limits the results to those documents that are at least the specified distance from the center point.
     */
    public function __construct(
        Document|Serializable|GeometryInterface|stdClass|array $geometry,
        Optional|int $maxDistance = Optional::Undefined,
        Optional|int $minDistance = Optional::Undefined,
    ) {
        $this->geometry = $geometry;
        $this->maxDistance = $maxDistance;
        $this->minDistance = $minDistance;
    }
}
