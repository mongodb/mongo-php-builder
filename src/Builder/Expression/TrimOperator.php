<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Expression;

use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\Optional;

/**
 * Removes whitespace or the specified characters from the beginning and end of a string.
 * New in version 4.0.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/trim/
 */
class TrimOperator implements ResolvesToString
{
    public const NAME = '$trim';
    public const ENCODE = Encode::Object;

    /** @var ResolvesToString|non-empty-string $input The string to trim. The argument can be any valid expression that resolves to a string. */
    public readonly ResolvesToString|string $input;

    /**
     * @var Optional|ResolvesToString|non-empty-string $chars The character(s) to trim from the beginning of the input.
     * The argument can be any valid expression that resolves to a string. The $ltrim operator breaks down the string into individual UTF code point to trim from input.
     * If unspecified, $ltrim removes whitespace characters, including the null character.
     */
    public readonly Optional|ResolvesToString|string $chars;

    /**
     * @param ResolvesToString|non-empty-string $input The string to trim. The argument can be any valid expression that resolves to a string.
     * @param Optional|ResolvesToString|non-empty-string $chars The character(s) to trim from the beginning of the input.
     * The argument can be any valid expression that resolves to a string. The $ltrim operator breaks down the string into individual UTF code point to trim from input.
     * If unspecified, $ltrim removes whitespace characters, including the null character.
     */
    public function __construct(
        ResolvesToString|string $input,
        Optional|ResolvesToString|string $chars = Optional::Undefined,
    ) {
        $this->input = $input;
        $this->chars = $chars;
    }
}
