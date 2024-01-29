<?php

declare(strict_types=1);

namespace MongoDB\Tests\Builder\Stage;

use MongoDB\Builder\Pipeline;
use MongoDB\Builder\Stage;
use MongoDB\Tests\Builder\PipelineTestCase;

/**
 * Test $search stage
 */
class SearchStageTest extends PipelineTestCase
{
    public function testAdvancedExample(): void
    {
        $pipeline = new Pipeline(
            Stage::search(
            )
        );

        $this->assertSamePipeline(Pipelines::SearchAdvancedExample, $pipeline);
    }

    public function testAutocompleteExample(): void
    {
        $pipeline = new Pipeline();

        $this->assertSamePipeline(Pipelines::SearchAutocompleteExample, $pipeline);
    }

    public function testBasicExample(): void
    {
        $pipeline = new Pipeline();

        $this->assertSamePipeline(Pipelines::SearchBasicExample, $pipeline);
    }

    public function testCompoundExample(): void
    {
        $pipeline = new Pipeline();

        $this->assertSamePipeline(Pipelines::SearchCompoundExample, $pipeline);
    }

    public function testMultiFieldExample(): void
    {
        $pipeline = new Pipeline();

        $this->assertSamePipeline(Pipelines::SearchMultiFieldExample, $pipeline);
    }

    public function testWildcardExample(): void
    {
        $pipeline = new Pipeline();

        $this->assertSamePipeline(Pipelines::SearchWildcardExample, $pipeline);
    }
}
