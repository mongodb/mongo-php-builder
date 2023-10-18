<?php

declare(strict_types=1);

namespace MongoDB\Tests\Builder;

use MongoDB\Builder\BuilderEncoder;
use MongoDB\Builder\Pipeline;
use PHPUnit\Framework\TestCase;

use function var_export;

class PipelineTestCase extends TestCase
{
    final public static function assertSamePipeline(array $expected, Pipeline $pipeline): void
    {
        $codec = new BuilderEncoder();
        $actual = $codec->encode($pipeline);

        self::assertEquals($expected, $actual, var_export($actual, true));
    }
}
