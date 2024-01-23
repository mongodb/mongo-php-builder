<?php

declare(strict_types=1);

namespace MongoDB\Builder\Encoder;

use LogicException;
use MongoDB\Builder\BuilderEncoder;
use MongoDB\Builder\Type\CombinedFieldQuery;
use MongoDB\Codec\EncodeIfSupported;
use MongoDB\Exception\UnsupportedValueException;
use stdClass;

use function get_debug_type;
use function get_object_vars;
use function is_array;
use function is_object;
use function sprintf;

/** @template-implements ExpressionEncoder<CombinedFieldQuery, stdClass> */
class CombinedFieldQueryEncoder implements ExpressionEncoder
{
    /** @template-use EncodeIfSupported<CombinedFieldQuery, string> */
    use EncodeIfSupported;

    public function __construct(private readonly BuilderEncoder $encoder)
    {
    }

    /** @psalm-assert-if-true CombinedFieldQuery $value */
    public function canEncode(mixed $value): bool
    {
        return $value instanceof CombinedFieldQuery;
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
        foreach ($value->fieldQueries as $filter) {
            $filter = $this->recursiveEncode($filter);
            if (is_object($filter)) {
                $filter = get_object_vars($filter);
            } elseif (! is_array($filter)) {
                throw new LogicException(sprintf('Query filters must an array or an object. Got "%s"', get_debug_type($filter)));
            }

            foreach ($filter as $key => $filterValue) {
                $result->{$key} = $filterValue;
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
