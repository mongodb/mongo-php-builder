<?php

declare(strict_types=1);

namespace MongoDB\Builder\Type;

/**
 * Marker interface for MongoDB operators.
 */
interface OperatorInterface
{
    /** To be overridden by implementing classes */
    public const ENCODE = Encode::Single;

    public function getOperator(): string;
}
