<?php

declare(strict_types=1);

namespace MongoDB\Builder\Type;

enum TimeUnit: string implements Dictionnary
{
    case Year = 'year';
    case Quarter = 'quarter';
    case Week = 'week';
    case Month = 'month';
    case Day = 'day';
    case Hour = 'hour';
    case Minute = 'minute';
    case Second = 'second';
    case Millisecond = 'millisecond';

    public function getValue(): string
    {
        return $this->value;
    }
}
