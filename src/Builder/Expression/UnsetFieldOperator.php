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
 * You can use $unsetField to remove fields with names that contain periods (.) or that start with dollar signs ($).
 * $unsetField is an alias for $setField using $$REMOVE to remove fields.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/unsetField/
 */
class UnsetFieldOperator implements ResolvesToObject
{
    public const NAME = '$unsetField';
    public const ENCODE = Encode::Object;

    /** @var ResolvesToString|non-empty-string $field Field in the input object that you want to add, update, or remove. field can be any valid expression that resolves to a string constant. */
    public readonly ResolvesToString|string $field;

    /** @var Document|ResolvesToObject|Serializable|array|stdClass $input Document that contains the field that you want to add or update. input must resolve to an object, missing, null, or undefined. */
    public readonly Document|Serializable|ResolvesToObject|stdClass|array $input;

    /**
     * @param ResolvesToString|non-empty-string $field Field in the input object that you want to add, update, or remove. field can be any valid expression that resolves to a string constant.
     * @param Document|ResolvesToObject|Serializable|array|stdClass $input Document that contains the field that you want to add or update. input must resolve to an object, missing, null, or undefined.
     */
    public function __construct(
        ResolvesToString|string $field,
        Document|Serializable|ResolvesToObject|stdClass|array $input,
    ) {
        $this->field = $field;
        $this->input = $input;
    }
}
