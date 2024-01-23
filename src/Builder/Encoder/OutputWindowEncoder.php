<?php

declare(strict_types=1);

namespace MongoDB\Builder\Encoder;

use LogicException;
use MongoDB\Builder\BuilderEncoder;
use MongoDB\Builder\Type\Optional;
use MongoDB\Builder\Type\OutputWindow;
use MongoDB\Builder\Type\WindowInterface;
use MongoDB\Codec\EncodeIfSupported;
use MongoDB\Exception\UnsupportedValueException;
use stdClass;

use function array_key_first;
use function get_debug_type;
use function get_object_vars;
use function is_array;
use function is_object;
use function MongoDB\is_first_key_operator;
use function sprintf;

/** @template-implements ExpressionEncoder<OutputWindow, stdClass> */
class OutputWindowEncoder implements ExpressionEncoder
{
    /** @template-use EncodeIfSupported<OutputWindow, stdClass> */
    use EncodeIfSupported;

    public function __construct(protected readonly BuilderEncoder $encoder)
    {
    }

    /** @psalm-assert-if-true OutputWindow $value */
    public function canEncode(mixed $value): bool
    {
        return $value instanceof OutputWindow;
    }

    /**
     * {@inheritdoc}
     */
    public function encode($value): stdClass
    {
        if (! $this->canEncode($value)) {
            throw UnsupportedValueException::invalidEncodableValue($value);
        }

        $result = $this->recursiveEncode($value->operator);

        // Transform the result into an stdClass if a document is provided
        if (! $value->operator instanceof WindowInterface && (is_array($result) || is_object($result))) {
            if (! is_first_key_operator($result)) {
                throw new LogicException(sprintf('Expected OutputWindow::$operator to be an operator. Got "%s"', array_key_first((array) $result)));
            }

            $result = (object) $result;
        }

        if (! $result instanceof stdClass) {
            throw new LogicException(sprintf('Expected OutputWindow::$operator to be an stdClass, array or WindowInterface. Got "%s"', get_debug_type($result)));
        }

        if ($value->window !== Optional::Undefined) {
            $result->window = $this->recursiveEncode($value->window);
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
