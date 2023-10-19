<?php

declare(strict_types=1);

namespace MongoDB\CodeGenerator;

use MongoDB\Builder\Pipeline;
use MongoDB\CodeGenerator\Definition\GeneratorDefinition;
use MongoDB\CodeGenerator\Definition\OperatorDefinition;
use MongoDB\Tests\Builder\PipelineTestCase;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\Type;
use RuntimeException;
use Throwable;

use function json_encode;
use function ksort;
use function sprintf;
use function str_replace;
use function ucwords;

use const JSON_PRETTY_PRINT;

/**
 * Generates a tests for all operators.
 */
class OperatorTestGenerator extends OperatorGenerator
{
    public function generate(GeneratorDefinition $definition): void
    {
        foreach ($this->getOperators($definition) as $operator) {
            // Skip operators without tests
            if (! $operator->tests) {
                continue;
            }

            try {
                $this->writeFile($this->createClass($definition, $operator), false);
            } catch (Throwable $e) {
                throw new RuntimeException(sprintf('Failed to generate class for operator "%s"', $operator->name), 0, $e);
            }
        }
    }

    public function createClass(GeneratorDefinition $definition, OperatorDefinition $operator): PhpNamespace
    {
        $testNamespace = str_replace('MongoDB', 'MongoDB\\Tests', $definition->namespace);
        $testClass = $this->getOperatorClassName($definition, $operator) . 'Test';

        $namespace = $this->readFile($testNamespace, $testClass)?->getNamespaces()[$testNamespace] ?? null;
        $namespace ??= new PhpNamespace($testNamespace);

        $class = $namespace->getClasses()[$testClass] ?? null;
        $class ??= $namespace->addClass($testClass);
        $namespace->addUse(PipelineTestCase::class);
        $class->setExtends(PipelineTestCase::class);
        $namespace->addUse(Pipeline::class);

        foreach ($operator->tests as $test) {
            $testName = str_replace(' ', '', ucwords(str_replace('$', '', $test->name)));

            if ($class->hasMethod('test' . $testName)) {
                $testMethod = $class->getMethod('test' . $testName);
            } else {
                $testMethod = $class->addMethod('test' . $testName);
                $testMethod->setBody(<<<PHP
                \$pipeline = new Pipeline();

                \$expected = \$this->getExpected{$testName}();

                \$this->assertSamePipeline(\$expected, \$pipeline);
                PHP);
            }

            $testMethod->setComment('@see getExpected' . $testName);
            $testMethod->setPublic();
            $testMethod->setReturnType(Type::Void);

            $expectedMethod = $class->hasMethod('getExpected' . $testName)
                ? $class->getMethod('getExpected' . $testName)
                : $class->addMethod('getExpected' . $testName);
            $expectedMethod->setPublic();
            $expectedMethod->setReturnType(Type::String);
            $expectedMethod->setComment('THIS METHOD IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!');
            $expectedMethod->addComment('');
            $expectedMethod->addComment('@see test' . $testName);
            $expectedMethod->addComment('');

            // Replace namespace BSON classes with use statements
            $expected = json_encode($test->pipeline, JSON_PRETTY_PRINT);

            $expectedMethod->setBody(<<<PHP
            return <<<'JSON'
            {$expected}
            JSON;
            PHP);
        }

        $methods = $class->getMethods();
        ksort($methods);
        $class->setMethods($methods);

        return $namespace;
    }
}
