<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Stage;

use MongoDB\BSON\Type;
use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\ExpressionInterface;
use MongoDB\Builder\Type\StageInterface;
use MongoDB\Exception\InvalidArgumentException;
use stdClass;

use function is_string;

/**
 * Adds new fields to documents. Outputs documents that contain all existing fields from the input documents and newly added fields.
 * Alias for $addFields.
 *
 * @see https://www.mongodb.com/docs/manual/reference/operator/aggregation/set/
 */
readonly class SetStage implements StageInterface
{
    public const NAME = '$set';
    public const ENCODE = Encode::Single;

    /** @param stdClass<ExpressionInterface|Type|array|bool|float|int|non-empty-string|null|stdClass> ...$field */
    public stdClass $field;

    /**
     * @param ExpressionInterface|Type|array|bool|float|int|non-empty-string|null|stdClass ...$field
     */
    public function __construct(Type|ExpressionInterface|stdClass|array|bool|float|int|null|string ...$field)
    {
        if (\count($field) < 1) {
            throw new \InvalidArgumentException(\sprintf('Expected at least %d values for $field, got %d.', 1, \count($field)));
        }
        foreach($field as $key => $value) {
            if (! is_string($key)) {
                throw new InvalidArgumentException('Expected $field arguments to be a map (object), named arguments (<name>:<value>) or array unpacking ...[\'<name>\' => <value>] must be used');
            }
        }
        $field = (object) $field;
        $this->field = $field;
    }
}
