<?php

declare(strict_types=1);

namespace MongoDB\Builder\Encoder;

use MongoDB\Builder\BuilderEncoder;
use MongoDB\Builder\Type\FieldPathInterface;
use MongoDB\Codec\EncodeIfSupported;
use MongoDB\Exception\UnsupportedValueException;

/** @template-implements Encoder<FieldPathInterface, string> */
class FieldPathEncoder implements ExpressionEncoder
{
    /** @template-use EncodeIfSupported<FieldPathInterface, string> */
    use EncodeIfSupported;

    public function __construct(private readonly BuilderEncoder $encoder)
    {
    }

    public static function createForEncoder(BuilderEncoder $encoder): static
    {
        return new self($encoder);
    }

    /** @psalm-assert-if-true FieldPathInterface $value */
    public function canEncode(mixed $value): bool
    {
        return $value instanceof FieldPathInterface;
    }

    /**
     * {@inheritdoc}
     */
    public function encode($value): string
    {
        if (! $this->canEncode($value)) {
            throw UnsupportedValueException::invalidEncodableValue($value);
        }

        // TODO: needs method because of interface
        return '$' . $value->name;
    }
}
