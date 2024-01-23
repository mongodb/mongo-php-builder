<?php

declare(strict_types=1);

namespace MongoDB\Builder;

use MongoDB\Builder\Encoder\CombinedFieldQueryEncoder;
use MongoDB\Builder\Encoder\ExpressionEncoder;
use MongoDB\Builder\Encoder\FieldPathEncoder;
use MongoDB\Builder\Encoder\OperatorEncoder;
use MongoDB\Builder\Encoder\OutputWindowEncoder;
use MongoDB\Builder\Encoder\PipelineEncoder;
use MongoDB\Builder\Encoder\QueryEncoder;
use MongoDB\Builder\Encoder\VariableEncoder;
use MongoDB\Builder\Expression\Variable;
use MongoDB\Builder\Type\CombinedFieldQuery;
use MongoDB\Builder\Type\ExpressionInterface;
use MongoDB\Builder\Type\FieldPathInterface;
use MongoDB\Builder\Type\OperatorInterface;
use MongoDB\Builder\Type\OutputWindow;
use MongoDB\Builder\Type\QueryInterface;
use MongoDB\Builder\Type\QueryObject;
use MongoDB\Builder\Type\StageInterface;
use MongoDB\Codec\EncodeIfSupported;
use MongoDB\Codec\Encoder;
use MongoDB\Exception\UnsupportedValueException;
use stdClass;

use function is_object;

/** @template-implements Encoder<Pipeline|StageInterface|ExpressionInterface|QueryInterface, stdClass|array|string> */
class BuilderEncoder implements Encoder
{
    use EncodeIfSupported;

    /** @var array<class-string, class-string<ExpressionEncoder>> */
    private array $defaultEncoders = [
        Pipeline::class => PipelineEncoder::class,
        Variable::class => VariableEncoder::class,
        FieldPathInterface::class => FieldPathEncoder::class,
        CombinedFieldQuery::class => CombinedFieldQueryEncoder::class,
        QueryObject::class => QueryEncoder::class,
        OutputWindow::class => OutputWindowEncoder::class,
        OperatorInterface::class => OperatorEncoder::class,
    ];

    /** @var array<class-string, ExpressionEncoder> */
    private array $cachedEncoders = [];

    /** @param array<class-string, class-string<ExpressionEncoder>> $customEncoders */
    public function __construct(private readonly array $customEncoders = [])
    {
    }

    /**
     * {@inheritdoc}
     */
    public function canEncode($value): bool
    {
        if (! is_object($value)) {
            return false;
        }

        $encoder = $this->getEncoderFor($value);

        return $encoder !== null && $encoder->canEncode($value);
    }

    /**
     * {@inheritdoc}
     */
    public function encode($value): stdClass|array|string
    {
        $encoder = $this->getEncoderFor($value);

        if (! $encoder || ! $encoder->canEncode($value)) {
            throw UnsupportedValueException::invalidEncodableValue($value);
        }

        return $encoder->encode($value);
    }

    private function getEncoderFor(object $value): ExpressionEncoder|null
    {
        $valueClass = $value::class;
        if (isset($this->cachedEncoders[$valueClass])) {
            return $this->cachedEncoders[$valueClass];
        }

        $encoderList = $this->customEncoders + $this->defaultEncoders;

        // First attempt: match class name exactly
        foreach ($encoderList as $className => $encoderClass) {
            if ($className == $valueClass) {
                return $this->cachedEncoders[$valueClass] = new $encoderClass($this);
            }
        }

        // Second attempt: catch child classes
        foreach ($encoderList as $className => $encoderClass) {
            if ($value instanceof $className) {
                return $this->cachedEncoders[$valueClass] = new $encoderClass($this);
            }
        }

        return null;
    }
}
