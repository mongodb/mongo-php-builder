<?php

declare(strict_types=1);

namespace MongoDB\Builder\Encoder;

use MongoDB\Builder\BuilderEncoder;
use MongoDB\Builder\Expression\Variable;
use MongoDB\Codec\EncodeIfSupported;
use MongoDB\Exception\UnsupportedValueException;

/** @template-implements ExpressionEncoder<Variable, string> */
class VariableEncoder implements ExpressionEncoder
{
    /** @template-use EncodeIfSupported<Variable, string> */
    use EncodeIfSupported;

    public function __construct(protected readonly BuilderEncoder $encoder)
    {
    }

    /** @psalm-assert-if-true Variable $value */
    public function canEncode(mixed $value): bool
    {
        return $value instanceof Variable;
    }

    /**
     * {@inheritdoc}
     */
    public function encode($value): string
    {
        if (! $this->canEncode($value)) {
            throw UnsupportedValueException::invalidEncodableValue($value);
        }

        return '$$' . $value->name;
    }
}
