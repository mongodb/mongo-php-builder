<?php

declare(strict_types=1);

namespace MongoDB\CodeGenerator;

use MongoDB\Builder\Pipeline;
use MongoDB\CodeGenerator\Definition\GeneratorDefinition;
use MongoDB\CodeGenerator\Definition\OperatorDefinition;
use MongoDB\CodeGenerator\TestCase\PipelineConverter;
use MongoDB\Tests\Builder\PipelineTestCase;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\Type;
use RuntimeException;
use Throwable;

use function ksort;
use function preg_replace_callback;
use function sprintf;
use function str_replace;

/**
 * Generates a tests for all operators.
 */
class OperatorTestGenerator extends OperatorGenerator
{
    public function generate(GeneratorDefinition $definition): void
    {
        foreach ($this->getOperators($definition) as $operator) {
            // Skip operators without tests
            if ($operator->testsFile === null) {
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
        $tests = (new PipelineConverter())->getTestsAsRawPhp($operator->testsFile);

        $testNamespace = str_replace('MongoDB', 'MongoDB\\Tests', $definition->namespace);
        $testClass = $this->getOperatorClassName($definition, $operator) . 'Test';

        $namespace = $this->readFile($testNamespace, $testClass)?->getNamespaces()[$testNamespace] ?? null;
        $namespace ??= new PhpNamespace($testNamespace);

        $class = $namespace->getClasses()[$testClass] ?? null;
        $class ??= $namespace->addClass($testClass);
        $namespace->addUse(PipelineTestCase::class);
        $class->setExtends(PipelineTestCase::class);
        $namespace->addUse(Pipeline::class);

        foreach ($tests as $testName => $expected) {
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
            $expectedMethod->setReturnType(Type::Array);
            $expectedMethod->setComment('THIS METHOD IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!');
            $expectedMethod->addComment('');
            $expectedMethod->addComment('@see test' . $testName);
            $expectedMethod->addComment('');
            $expectedMethod->addComment('@return list<array<string, mixed>>');

            // Replace namespace BSON classes with use statements
            $expected = preg_replace_callback(
                '/\\\?MongoDB\\\BSON\\\([A-Z][a-zA-Z0-9]+)/',
                function ($matches) use ($namespace): string {
                    $namespace->addUse($matches[0]);

                    return $matches[1];
                },
                $expected,
            );

            $expectedMethod->setBody(<<<PHP
            return {$expected};
            PHP);
        }

        $methods = $class->getMethods();
        ksort($methods);
        $class->setMethods($methods);

        return $namespace;
    }
}
