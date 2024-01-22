<?php

declare(strict_types=1);

namespace MongoDB\Builder\Encoder;

use MongoDB\Builder\BuilderEncoder;
use MongoDB\Builder\Pipeline;
use MongoDB\Codec\EncodeIfSupported;
use MongoDB\Exception\UnsupportedValueException;
use stdClass;

/** @template-implements ExpressionEncoder<Pipeline, array> */
class PipelineEncoder implements ExpressionEncoder
{
    /** @template-use EncodeIfSupported<Pipeline, array> */
    use EncodeIfSupported;

    public function __construct(protected readonly BuilderEncoder $encoder)
    {
    }

    public static function createForEncoder(BuilderEncoder $encoder): static
    {
        return new self($encoder);
    }

    /** @psalm-assert-if-true Pipeline $value */
    public function canEncode(mixed $value): bool
    {
        return $value instanceof Pipeline;
    }

    /**
     * {@inheritdoc}
     */
    public function encode($value): stdClass|array|string
    {
        if (! $this->canEncode($value)) {
            throw UnsupportedValueException::invalidEncodableValue($value);
        }

        $encoded = [];
        foreach ($value->getIterator() as $stage) {
            // Todo: Needs StageEncoder
            $encoded[] = $this->encoder->encodeIfSupported($stage);
        }

        return $encoded;
    }
}
