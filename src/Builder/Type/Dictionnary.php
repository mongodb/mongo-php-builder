<?php

declare(strict_types=1);

namespace MongoDB\Builder\Type;

interface Dictionnary
{
    public function getValue(): string|int|array;
}
