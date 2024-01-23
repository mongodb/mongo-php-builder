<?php

declare(strict_types=1);

namespace MongoDB\Builder\Encoder;

use MongoDB\Builder\Pipeline;
use MongoDB\Codec\EncodeIfSupported;
use MongoDB\Exception\UnsupportedValueException;
use stdClass;

/** @template-extends AbstractExpressionEncoder<array, Pipeline> */
class PipelineEncoder extends AbstractExpressionEncoder
{
    /** @template-use EncodeIfSupported<array, Pipeline> */
    use EncodeIfSupported;

    public function canEncode(mixed $value): bool
    {
        return $value instanceof Pipeline;
    }

    public function encode(mixed $value): stdClass|array|string
    {
        if (! $this->canEncode($value)) {
            throw UnsupportedValueException::invalidEncodableValue($value);
        }

        $encoded = [];
        foreach ($value->getIterator() as $stage) {
            $encoded[] = $this->encoder->encodeIfSupported($stage);
        }

        return $encoded;
    }
}
