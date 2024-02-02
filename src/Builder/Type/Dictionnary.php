<?php

declare(strict_types=1);

namespace MongoDB\Builder\Type;

use stdClass;

interface Dictionnary
{
    public function getValue(): string|int|array|stdClass;
}
