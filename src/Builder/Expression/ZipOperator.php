<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Expression;

use MongoDB\BSON\PackedArray;
use MongoDB\Builder\Type\Encode;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Model\BSONArray;

use function array_is_list;
use function is_array;

/**
 * Merge two arrays together.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/zip/
 */
class ZipOperator implements ResolvesToArray
{
    public const NAME = '$zip';
    public const ENCODE = Encode::Object;

    /**
     * @var BSONArray|PackedArray|ResolvesToArray|array $inputs An array of expressions that resolve to arrays. The elements of these input arrays combine to form the arrays of the output array.
     * If any of the inputs arrays resolves to a value of null or refers to a missing field, $zip returns null.
     * If any of the inputs arrays does not resolve to an array or null nor refers to a missing field, $zip returns an error.
     */
    public readonly PackedArray|ResolvesToArray|BSONArray|array $inputs;

    /**
     * @var bool $useLongestLength A boolean which specifies whether the length of the longest array determines the number of arrays in the output array.
     * The default value is false: the shortest array length determines the number of arrays in the output array.
     */
    public readonly bool $useLongestLength;

    /**
     * @var BSONArray|PackedArray|array $defaults An array of default element values to use if the input arrays have different lengths. You must specify useLongestLength: true along with this field, or else $zip will return an error.
     * If useLongestLength: true but defaults is empty or not specified, $zip uses null as the default value.
     * If specifying a non-empty defaults, you must specify a default for each input array or else $zip will return an error.
     */
    public readonly PackedArray|BSONArray|array $defaults;

    /**
     * @param BSONArray|PackedArray|ResolvesToArray|array $inputs An array of expressions that resolve to arrays. The elements of these input arrays combine to form the arrays of the output array.
     * If any of the inputs arrays resolves to a value of null or refers to a missing field, $zip returns null.
     * If any of the inputs arrays does not resolve to an array or null nor refers to a missing field, $zip returns an error.
     * @param bool $useLongestLength A boolean which specifies whether the length of the longest array determines the number of arrays in the output array.
     * The default value is false: the shortest array length determines the number of arrays in the output array.
     * @param BSONArray|PackedArray|array $defaults An array of default element values to use if the input arrays have different lengths. You must specify useLongestLength: true along with this field, or else $zip will return an error.
     * If useLongestLength: true but defaults is empty or not specified, $zip uses null as the default value.
     * If specifying a non-empty defaults, you must specify a default for each input array or else $zip will return an error.
     */
    public function __construct(
        PackedArray|ResolvesToArray|BSONArray|array $inputs,
        bool $useLongestLength,
        PackedArray|BSONArray|array $defaults,
    ) {
        if (is_array($inputs) && ! array_is_list($inputs)) {
            throw new InvalidArgumentException('Expected $inputs argument to be a list, got an associative array.');
        }

        $this->inputs = $inputs;
        $this->useLongestLength = $useLongestLength;
        if (is_array($defaults) && ! array_is_list($defaults)) {
            throw new InvalidArgumentException('Expected $defaults argument to be a list, got an associative array.');
        }

        $this->defaults = $defaults;
    }
}
