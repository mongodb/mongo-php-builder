<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Expression;

use MongoDB\BSON\Type;
use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\ExpressionInterface;
use MongoDB\Builder\Type\Optional;
use stdClass;

/**
 * Converts a date/time string to a date object.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/dateFromString/
 */
class DateFromStringOperator implements ResolvesToDate
{
    public const NAME = '$dateFromString';
    public const ENCODE = Encode::Object;

    /** @var ResolvesToString|non-empty-string $dateString The date/time string to convert to a date object. */
    public readonly ResolvesToString|string $dateString;

    /**
     * @var Optional|ResolvesToString|non-empty-string $format The date format specification of the dateString. The format can be any expression that evaluates to a string literal, containing 0 or more format specifiers.
     * If unspecified, $dateFromString uses "%Y-%m-%dT%H:%M:%S.%LZ" as the default format but accepts a variety of formats and attempts to parse the dateString if possible.
     */
    public readonly Optional|ResolvesToString|string $format;

    /** @var Optional|ResolvesToString|non-empty-string $timezone The time zone to use to format the date. */
    public readonly Optional|ResolvesToString|string $timezone;

    /**
     * @var Optional|ExpressionInterface|Type|array|bool|float|int|non-empty-string|null|stdClass $onError If $dateFromString encounters an error while parsing the given dateString, it outputs the result value of the provided onError expression. This result value can be of any type.
     * If you do not specify onError, $dateFromString throws an error if it cannot parse dateString.
     */
    public readonly Optional|Type|ExpressionInterface|stdClass|array|bool|float|int|null|string $onError;

    /**
     * @var Optional|ExpressionInterface|Type|array|bool|float|int|non-empty-string|null|stdClass $onNull If the dateString provided to $dateFromString is null or missing, it outputs the result value of the provided onNull expression. This result value can be of any type.
     * If you do not specify onNull and dateString is null or missing, then $dateFromString outputs null.
     */
    public readonly Optional|Type|ExpressionInterface|stdClass|array|bool|float|int|null|string $onNull;

    /**
     * @param ResolvesToString|non-empty-string $dateString The date/time string to convert to a date object.
     * @param Optional|ResolvesToString|non-empty-string $format The date format specification of the dateString. The format can be any expression that evaluates to a string literal, containing 0 or more format specifiers.
     * If unspecified, $dateFromString uses "%Y-%m-%dT%H:%M:%S.%LZ" as the default format but accepts a variety of formats and attempts to parse the dateString if possible.
     * @param Optional|ResolvesToString|non-empty-string $timezone The time zone to use to format the date.
     * @param Optional|ExpressionInterface|Type|array|bool|float|int|non-empty-string|null|stdClass $onError If $dateFromString encounters an error while parsing the given dateString, it outputs the result value of the provided onError expression. This result value can be of any type.
     * If you do not specify onError, $dateFromString throws an error if it cannot parse dateString.
     * @param Optional|ExpressionInterface|Type|array|bool|float|int|non-empty-string|null|stdClass $onNull If the dateString provided to $dateFromString is null or missing, it outputs the result value of the provided onNull expression. This result value can be of any type.
     * If you do not specify onNull and dateString is null or missing, then $dateFromString outputs null.
     */
    public function __construct(
        ResolvesToString|string $dateString,
        Optional|ResolvesToString|string $format = Optional::Undefined,
        Optional|ResolvesToString|string $timezone = Optional::Undefined,
        Optional|Type|ExpressionInterface|stdClass|array|bool|float|int|null|string $onError = Optional::Undefined,
        Optional|Type|ExpressionInterface|stdClass|array|bool|float|int|null|string $onNull = Optional::Undefined,
    ) {
        $this->dateString = $dateString;
        $this->format = $format;
        $this->timezone = $timezone;
        $this->onError = $onError;
        $this->onNull = $onNull;
    }
}
