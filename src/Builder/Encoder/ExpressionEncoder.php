<?php

declare(strict_types=1);

namespace MongoDB\Builder\Encoder;

use MongoDB\Builder\BuilderEncoder;
use MongoDB\Codec\Encoder;

interface ExpressionEncoder extends Encoder
{
    public function __construct(BuilderEncoder $encoder);
}
