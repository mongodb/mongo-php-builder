<?php

declare(strict_types=1);

namespace MongoDB\CodeGenerator\TestCase;

use function json_decode;
use function shell_exec;
use function sprintf;

class PipelineConverter
{
    private const SCRIPT = __DIR__ . '/testsToPhp.js';

    /** @return array<string, string> */
    public function getTestsAsRawPhp(string $filename): array
    {
        $output = shell_exec(sprintf('node %s %s', self::SCRIPT, $filename));

        return json_decode($output, true);
    }
}
