<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Expression;

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\Timestamp;
use MongoDB\BSON\Type;
use MongoDB\BSON\UTCDateTime;
use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\ExpressionInterface;
use MongoDB\Builder\Type\OperatorInterface;
use MongoDB\Builder\Type\Optional;
use stdClass;

/**
 * Returns the date as a formatted string.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/dateToString/
 */
class DateToStringOperator implements ResolvesToString, OperatorInterface
{
    public const ENCODE = Encode::Object;

    /** @var ObjectId|ResolvesToDate|ResolvesToObjectId|ResolvesToTimestamp|Timestamp|UTCDateTime|int $date The date to convert to string. Must be a valid expression that resolves to a Date, a Timestamp, or an ObjectID. */
    public readonly ObjectId|Timestamp|UTCDateTime|ResolvesToDate|ResolvesToObjectId|ResolvesToTimestamp|int $date;

    /**
     * @var Optional|ResolvesToString|non-empty-string $format The date format specification of the dateString. The format can be any expression that evaluates to a string literal, containing 0 or more format specifiers.
     * If unspecified, $dateFromString uses "%Y-%m-%dT%H:%M:%S.%LZ" as the default format but accepts a variety of formats and attempts to parse the dateString if possible.
     */
    public readonly Optional|ResolvesToString|string $format;

    /** @var Optional|ResolvesToString|non-empty-string $timezone The time zone to use to format the date. */
    public readonly Optional|ResolvesToString|string $timezone;

    /**
     * @var Optional|ExpressionInterface|Type|array|bool|float|int|non-empty-string|null|stdClass $onNull The value to return if the date is null or missing.
     * If unspecified, $dateToString returns null if the date is null or missing.
     */
    public readonly Optional|Type|ExpressionInterface|stdClass|array|bool|float|int|null|string $onNull;

    /**
     * @param ObjectId|ResolvesToDate|ResolvesToObjectId|ResolvesToTimestamp|Timestamp|UTCDateTime|int $date The date to convert to string. Must be a valid expression that resolves to a Date, a Timestamp, or an ObjectID.
     * @param Optional|ResolvesToString|non-empty-string $format The date format specification of the dateString. The format can be any expression that evaluates to a string literal, containing 0 or more format specifiers.
     * If unspecified, $dateFromString uses "%Y-%m-%dT%H:%M:%S.%LZ" as the default format but accepts a variety of formats and attempts to parse the dateString if possible.
     * @param Optional|ResolvesToString|non-empty-string $timezone The time zone to use to format the date.
     * @param Optional|ExpressionInterface|Type|array|bool|float|int|non-empty-string|null|stdClass $onNull The value to return if the date is null or missing.
     * If unspecified, $dateToString returns null if the date is null or missing.
     */
    public function __construct(
        ObjectId|Timestamp|UTCDateTime|ResolvesToDate|ResolvesToObjectId|ResolvesToTimestamp|int $date,
        Optional|ResolvesToString|string $format = Optional::Undefined,
        Optional|ResolvesToString|string $timezone = Optional::Undefined,
        Optional|Type|ExpressionInterface|stdClass|array|bool|float|int|null|string $onNull = Optional::Undefined,
    ) {
        $this->date = $date;
        $this->format = $format;
        $this->timezone = $timezone;
        $this->onNull = $onNull;
    }

    public function getOperator(): string
    {
        return '$dateToString';
    }
}
