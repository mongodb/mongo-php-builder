<?php

declare(strict_types=1);

namespace MongoDB\Builder\Encoder;

use MongoDB\Builder\Type\Dictionnary;
use MongoDB\Codec\EncodeIfSupported;
use MongoDB\Exception\UnsupportedValueException;
use stdClass;

/** @template-extends AbstractExpressionEncoder<string, Dictionnary> */
class DictionaryEncoder extends AbstractExpressionEncoder
{
    /** @template-use EncodeIfSupported<string, Dictionnary> */
    use EncodeIfSupported;

    public function canEncode(mixed $value): bool
    {
        return $value instanceof Dictionnary;
    }

    public function encode(mixed $value): string|int|array|stdClass
    {
        if (! $this->canEncode($value)) {
            throw UnsupportedValueException::invalidEncodableValue($value);
        }

        return $value->getValue();
    }
}
