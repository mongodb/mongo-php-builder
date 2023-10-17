<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Query;

use MongoDB\BSON\Binary;
use MongoDB\BSON\Decimal128;
use MongoDB\BSON\Document;
use MongoDB\BSON\Int64;
use MongoDB\BSON\PackedArray;
use MongoDB\BSON\Regex;
use MongoDB\BSON\Serializable;
use MongoDB\BSON\Type;
use MongoDB\Builder\Type\ExpressionInterface;
use MongoDB\Builder\Type\GeometryInterface;
use MongoDB\Builder\Type\Optional;
use MongoDB\Builder\Type\QueryInterface;
use MongoDB\Model\BSONArray;
use stdClass;

/**
 * @internal
 */
trait FactoryTrait
{
    /**
     * Matches arrays that contain all elements specified in the query.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/all/
     * @param Type|array|bool|float|int|non-empty-string|null|stdClass ...$value
     */
    public static function all(Type|stdClass|array|bool|float|int|null|string ...$value): AllOperator
    {
        return new AllOperator(...$value);
    }

    /**
     * Joins query clauses with a logical AND returns all documents that match the conditions of both clauses.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/and/
     * @param Document|QueryInterface|Serializable|array|stdClass ...$expression
     */
    public static function and(Document|Serializable|QueryInterface|stdClass|array ...$expression): AndOperator
    {
        return new AndOperator(...$expression);
    }

    /**
     * Matches numeric or binary values in which a set of bit positions all have a value of 0.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/bitsAllClear/
     * @param BSONArray|Binary|PackedArray|array|int|non-empty-string $bitmask
     */
    public static function bitsAllClear(Binary|PackedArray|BSONArray|array|int|string $bitmask): BitsAllClearOperator
    {
        return new BitsAllClearOperator($bitmask);
    }

    /**
     * Matches numeric or binary values in which a set of bit positions all have a value of 1.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/bitsAllSet/
     * @param BSONArray|Binary|PackedArray|array|int|non-empty-string $bitmask
     */
    public static function bitsAllSet(Binary|PackedArray|BSONArray|array|int|string $bitmask): BitsAllSetOperator
    {
        return new BitsAllSetOperator($bitmask);
    }

    /**
     * Matches numeric or binary values in which any bit from a set of bit positions has a value of 0.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/bitsAnyClear/
     * @param BSONArray|Binary|PackedArray|array|int|non-empty-string $bitmask
     */
    public static function bitsAnyClear(Binary|PackedArray|BSONArray|array|int|string $bitmask): BitsAnyClearOperator
    {
        return new BitsAnyClearOperator($bitmask);
    }

    /**
     * Matches numeric or binary values in which any bit from a set of bit positions has a value of 1.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/bitsAnySet/
     * @param BSONArray|Binary|PackedArray|array|int|non-empty-string $bitmask
     */
    public static function bitsAnySet(Binary|PackedArray|BSONArray|array|int|string $bitmask): BitsAnySetOperator
    {
        return new BitsAnySetOperator($bitmask);
    }

    /**
     * Specifies a rectangular box using legacy coordinate pairs for $geoWithin queries. The 2d index supports $box.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/box/
     * @param BSONArray|PackedArray|array $value
     */
    public static function box(PackedArray|BSONArray|array $value): BoxOperator
    {
        return new BoxOperator($value);
    }

    /**
     * Specifies a circle using legacy coordinate pairs to $geoWithin queries when using planar geometry. The 2d index supports $center.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/center/
     * @param BSONArray|PackedArray|array $value
     */
    public static function center(PackedArray|BSONArray|array $value): CenterOperator
    {
        return new CenterOperator($value);
    }

    /**
     * Specifies a circle using either legacy coordinate pairs or GeoJSON format for $geoWithin queries when using spherical geometry. The 2dsphere and 2d indexes support $centerSphere.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/centerSphere/
     * @param BSONArray|PackedArray|array $value
     */
    public static function centerSphere(PackedArray|BSONArray|array $value): CenterSphereOperator
    {
        return new CenterSphereOperator($value);
    }

    /**
     * Adds a comment to a query predicate.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/comment/
     * @param non-empty-string $comment
     */
    public static function comment(string $comment): CommentOperator
    {
        return new CommentOperator($comment);
    }

    /**
     * The $elemMatch operator matches documents that contain an array field with at least one element that matches all the specified query criteria.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/elemMatch/
     * @param Document|QueryInterface|Serializable|array|stdClass $query
     */
    public static function elemMatch(Document|Serializable|QueryInterface|stdClass|array $query): ElemMatchOperator
    {
        return new ElemMatchOperator($query);
    }

    /**
     * Matches values that are equal to a specified value.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/eq/
     * @param Type|array|bool|float|int|non-empty-string|null|stdClass $value
     */
    public static function eq(Type|stdClass|array|bool|float|int|null|string $value): EqOperator
    {
        return new EqOperator($value);
    }

    /**
     * Matches documents that have the specified field.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/exists/
     * @param bool $exists
     */
    public static function exists(bool $exists): ExistsOperator
    {
        return new ExistsOperator($exists);
    }

    /**
     * Allows use of aggregation expressions within the query language.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/expr/
     * @param ExpressionInterface|Type|array|bool|float|int|non-empty-string|null|stdClass $expression
     */
    public static function expr(
        Type|ExpressionInterface|stdClass|array|bool|float|int|null|string $expression,
    ): ExprOperator
    {
        return new ExprOperator($expression);
    }

    /**
     * Selects geometries that intersect with a GeoJSON geometry. The 2dsphere index supports $geoIntersects.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/geoIntersects/
     * @param Document|GeometryInterface|Serializable|array|stdClass $geometry
     */
    public static function geoIntersects(
        Document|Serializable|GeometryInterface|stdClass|array $geometry,
    ): GeoIntersectsOperator
    {
        return new GeoIntersectsOperator($geometry);
    }

    /**
     * Specifies a geometry in GeoJSON format to geospatial query operators.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/geometry/
     * @param non-empty-string $type
     * @param BSONArray|PackedArray|array $coordinates
     * @param Document|Serializable|array|stdClass $crs
     */
    public static function geometry(
        string $type,
        PackedArray|BSONArray|array $coordinates,
        Document|Serializable|stdClass|array $crs,
    ): GeometryOperator
    {
        return new GeometryOperator($type, $coordinates, $crs);
    }

    /**
     * Selects geometries within a bounding GeoJSON geometry. The 2dsphere and 2d indexes support $geoWithin.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/geoWithin/
     * @param Document|GeometryInterface|Serializable|array|stdClass $geometry
     */
    public static function geoWithin(
        Document|Serializable|GeometryInterface|stdClass|array $geometry,
    ): GeoWithinOperator
    {
        return new GeoWithinOperator($geometry);
    }

    /**
     * Matches values that are greater than a specified value.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/gt/
     * @param Type|array|bool|float|int|non-empty-string|null|stdClass $value
     */
    public static function gt(Type|stdClass|array|bool|float|int|null|string $value): GtOperator
    {
        return new GtOperator($value);
    }

    /**
     * Matches values that are greater than or equal to a specified value.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/gte/
     * @param Type|array|bool|float|int|non-empty-string|null|stdClass $value
     */
    public static function gte(Type|stdClass|array|bool|float|int|null|string $value): GteOperator
    {
        return new GteOperator($value);
    }

    /**
     * Matches any of the values specified in an array.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/in/
     * @param BSONArray|PackedArray|array $value
     */
    public static function in(PackedArray|BSONArray|array $value): InOperator
    {
        return new InOperator($value);
    }

    /**
     * Validate documents against the given JSON Schema.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/jsonSchema/
     * @param Document|Serializable|array|stdClass $schema
     */
    public static function jsonSchema(Document|Serializable|stdClass|array $schema): JsonSchemaOperator
    {
        return new JsonSchemaOperator($schema);
    }

    /**
     * Matches values that are less than a specified value.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/lt/
     * @param Type|array|bool|float|int|non-empty-string|null|stdClass $value
     */
    public static function lt(Type|stdClass|array|bool|float|int|null|string $value): LtOperator
    {
        return new LtOperator($value);
    }

    /**
     * Matches values that are less than or equal to a specified value.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/lte/
     * @param Type|array|bool|float|int|non-empty-string|null|stdClass $value
     */
    public static function lte(Type|stdClass|array|bool|float|int|null|string $value): LteOperator
    {
        return new LteOperator($value);
    }

    /**
     * Specifies a maximum distance to limit the results of $near and $nearSphere queries. The 2dsphere and 2d indexes support $maxDistance.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/maxDistance/
     * @param Decimal128|Int64|float|int $value
     */
    public static function maxDistance(Decimal128|Int64|float|int $value): MaxDistanceOperator
    {
        return new MaxDistanceOperator($value);
    }

    /**
     * Specifies a minimum distance to limit the results of $near and $nearSphere queries. For use with 2dsphere index only.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/minDistance/
     * @param Int64|float|int $value
     */
    public static function minDistance(Int64|float|int $value): MinDistanceOperator
    {
        return new MinDistanceOperator($value);
    }

    /**
     * Performs a modulo operation on the value of a field and selects documents with a specified result.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/mod/
     * @param int $divisor
     * @param int $remainder
     */
    public static function mod(int $divisor, int $remainder): ModOperator
    {
        return new ModOperator($divisor, $remainder);
    }

    /**
     * A special hint that can be provided via the sort() or hint() methods that can be used to force either a forward or reverse collection scan.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/meta/natural/
     */
    public static function natural(): NaturalOperator
    {
        return new NaturalOperator();
    }

    /**
     * Matches all values that are not equal to a specified value.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/ne/
     * @param Type|array|bool|float|int|non-empty-string|null|stdClass $value
     */
    public static function ne(Type|stdClass|array|bool|float|int|null|string $value): NeOperator
    {
        return new NeOperator($value);
    }

    /**
     * Returns geospatial objects in proximity to a point. Requires a geospatial index. The 2dsphere and 2d indexes support $near.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/near/
     * @param Document|GeometryInterface|Serializable|array|stdClass $geometry
     * @param Optional|int $maxDistance Distance in meters. Limits the results to those documents that are at most the specified distance from the center point.
     * @param Optional|int $minDistance Distance in meters. Limits the results to those documents that are at least the specified distance from the center point.
     */
    public static function near(
        Document|Serializable|GeometryInterface|stdClass|array $geometry,
        Optional|int $maxDistance = Optional::Undefined,
        Optional|int $minDistance = Optional::Undefined,
    ): NearOperator
    {
        return new NearOperator($geometry, $maxDistance, $minDistance);
    }

    /**
     * Returns geospatial objects in proximity to a point on a sphere. Requires a geospatial index. The 2dsphere and 2d indexes support $nearSphere.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/nearSphere/
     * @param Document|GeometryInterface|Serializable|array|stdClass $geometry
     * @param Optional|int $maxDistance Distance in meters.
     * @param Optional|int $minDistance Distance in meters. Limits the results to those documents that are at least the specified distance from the center point.
     */
    public static function nearSphere(
        Document|Serializable|GeometryInterface|stdClass|array $geometry,
        Optional|int $maxDistance = Optional::Undefined,
        Optional|int $minDistance = Optional::Undefined,
    ): NearSphereOperator
    {
        return new NearSphereOperator($geometry, $maxDistance, $minDistance);
    }

    /**
     * Matches none of the values specified in an array.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/nin/
     * @param BSONArray|PackedArray|array $value
     */
    public static function nin(PackedArray|BSONArray|array $value): NinOperator
    {
        return new NinOperator($value);
    }

    /**
     * Joins query clauses with a logical NOR returns all documents that fail to match both clauses.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/nor/
     * @param Document|QueryInterface|Serializable|array|stdClass ...$expression
     */
    public static function nor(Document|Serializable|QueryInterface|stdClass|array ...$expression): NorOperator
    {
        return new NorOperator(...$expression);
    }

    /**
     * Inverts the effect of a query expression and returns documents that do not match the query expression.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/not/
     * @param Document|QueryInterface|Regex|Serializable|array|stdClass $expression
     */
    public static function not(Document|Regex|Serializable|QueryInterface|stdClass|array $expression): NotOperator
    {
        return new NotOperator($expression);
    }

    /**
     * Joins query clauses with a logical OR returns all documents that match the conditions of either clause.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/or/
     * @param Document|QueryInterface|Serializable|array|stdClass ...$expression
     */
    public static function or(Document|Serializable|QueryInterface|stdClass|array ...$expression): OrOperator
    {
        return new OrOperator(...$expression);
    }

    /**
     * Specifies a polygon to using legacy coordinate pairs for $geoWithin queries. The 2d index supports $center.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/polygon/
     * @param BSONArray|PackedArray|array $points
     */
    public static function polygon(PackedArray|BSONArray|array $points): PolygonOperator
    {
        return new PolygonOperator($points);
    }

    /**
     * Generates a random float between 0 and 1.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/rand/
     */
    public static function rand(): RandOperator
    {
        return new RandOperator();
    }

    /**
     * Selects documents where values match a specified regular expression.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/regex/
     * @param Regex $regex
     */
    public static function regex(Regex $regex): RegexOperator
    {
        return new RegexOperator($regex);
    }

    /**
     * Selects documents if the array field is a specified size.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/size/
     * @param int $value
     */
    public static function size(int $value): SizeOperator
    {
        return new SizeOperator($value);
    }

    /**
     * Performs text search.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/text/
     * @param non-empty-string $search A string of terms that MongoDB parses and uses to query the text index. MongoDB performs a logical OR search of the terms unless specified as a phrase.
     * @param Optional|non-empty-string $language The language that determines the list of stop words for the search and the rules for the stemmer and tokenizer. If not specified, the search uses the default language of the index.
     * If you specify a default_language value of none, then the text index parses through each word in the field, including stop words, and ignores suffix stemming.
     * @param Optional|bool $caseSensitive A boolean flag to enable or disable case sensitive search. Defaults to false; i.e. the search defers to the case insensitivity of the text index.
     * @param Optional|bool $diacriticSensitive A boolean flag to enable or disable diacritic sensitive search against version 3 text indexes. Defaults to false; i.e. the search defers to the diacritic insensitivity of the text index.
     * Text searches against earlier versions of the text index are inherently diacritic sensitive and cannot be diacritic insensitive. As such, the $diacriticSensitive option has no effect with earlier versions of the text index.
     */
    public static function text(
        string $search,
        Optional|string $language = Optional::Undefined,
        Optional|bool $caseSensitive = Optional::Undefined,
        Optional|bool $diacriticSensitive = Optional::Undefined,
    ): TextOperator
    {
        return new TextOperator($search, $language, $caseSensitive, $diacriticSensitive);
    }

    /**
     * Selects documents if a field is of the specified type.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/type/
     * @param BSONArray|PackedArray|array|int|non-empty-string $type
     */
    public static function type(PackedArray|BSONArray|array|int|string $type): TypeOperator
    {
        return new TypeOperator($type);
    }

    /**
     * Matches documents that satisfy a JavaScript expression.
     *
     * @see https://www.mongodb.com/docs/manual/reference/operator/query/where/
     * @param non-empty-string $function
     */
    public static function where(string $function): WhereOperator
    {
        return new WhereOperator($function);
    }
}
