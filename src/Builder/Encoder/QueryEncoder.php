<?php

declare(strict_types=1);

namespace MongoDB\Builder\Encoder;

use LogicException;
use MongoDB\Builder\BuilderEncoder;
use MongoDB\Builder\Expression\Variable;
use MongoDB\Builder\Type\QueryInterface;
use MongoDB\Builder\Type\QueryObject;
use MongoDB\Codec\EncodeIfSupported;
use MongoDB\Exception\UnsupportedValueException;
use stdClass;

use function get_object_vars;
use function is_array;
use function property_exists;
use function sprintf;

/** @template-implements ExpressionEncoder<Variable, stdClass> */
class QueryEncoder implements ExpressionEncoder
{
    /** @template-use EncodeIfSupported<Variable, string> */
    use EncodeIfSupported;

    public function __construct(protected readonly BuilderEncoder $encoder)
    {
    }

    /** @psalm-assert-if-true Variable $value */
    public function canEncode(mixed $value): bool
    {
        return $value instanceof QueryObject;
    }

    /**
     * {@inheritdoc}
     */
    public function encode($value): stdClass
    {
        if (! $this->canEncode($value)) {
            throw UnsupportedValueException::invalidEncodableValue($value);
        }

        $result = new stdClass();
        foreach ($value->queries as $key => $value) {
            if ($value instanceof QueryInterface) {
                // The sub-objects is merged into the main object, replacing duplicate keys
                foreach (get_object_vars($this->recursiveEncode($value)) as $subKey => $subValue) {
                    if (property_exists($result, (string) $subKey)) {
                        throw new LogicException(sprintf('Duplicate key "%s" in query object', $subKey));
                    }

                    $result->{$subKey} = $subValue;
                }
            } else {
                if (property_exists($result, (string) $key)) {
                    throw new LogicException(sprintf('Duplicate key "%s" in query object', $key));
                }

                $result->{$key} = $this->encoder->encodeIfSupported($value);
            }
        }

        return $result;
    }

    /**
     * Nested arrays and objects must be encoded recursively.
     */
    private function recursiveEncode(mixed $value): mixed
    {
        if (is_array($value)) {
            foreach ($value as $key => $val) {
                $value[$key] = $this->recursiveEncode($val);
            }

            return $value;
        }

        if ($value instanceof stdClass) {
            foreach (get_object_vars($value) as $key => $val) {
                $value->{$key} = $this->recursiveEncode($val);
            }

            return $value;
        }

        return $this->encoder->encodeIfSupported($value);
    }
}
