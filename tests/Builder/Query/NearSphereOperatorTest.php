<?php

declare(strict_types=1);

namespace MongoDB\Tests\Builder\Query;

use MongoDB\Builder\Pipeline;
use MongoDB\Tests\Builder\PipelineTestCase;

/**
 * Test $nearSphere query
 */
class NearSphereOperatorTest extends PipelineTestCase
{
    public function testSpecifyCenterPointUsingGeoJSON(): void
    {
        $pipeline = new Pipeline();

        $this->assertSamePipeline(Pipelines::NearSphereSpecifyCenterPointUsingGeoJSON, $pipeline);
    }

    public function testSpecifyCenterPointUsingLegacyCoordinates(): void
    {
        $pipeline = new Pipeline();

        $this->assertSamePipeline(Pipelines::NearSphereSpecifyCenterPointUsingLegacyCoordinates, $pipeline);
    }
}
