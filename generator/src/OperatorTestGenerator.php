<?php

declare(strict_types=1);

namespace MongoDB\CodeGenerator;

use MongoDB\Builder\Pipeline;
use MongoDB\CodeGenerator\Definition\GeneratorDefinition;
use MongoDB\CodeGenerator\Definition\OperatorDefinition;
use MongoDB\Tests\Builder\PipelineTestCase;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Literal;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\Type;
use RuntimeException;
use Throwable;

use function basename;
use function json_encode;
use function ksort;
use function sprintf;
use function str_replace;
use function strtoupper;
use function ucwords;

use const JSON_PRETTY_PRINT;

/**
 * Generates a tests for all operators.
 */
class OperatorTestGenerator extends OperatorGenerator
{
    private const DATA_CLASS = 'Pipelines';

    public function generate(GeneratorDefinition $definition): void
    {
        $dataNamespace = $this->createExpectedClass($definition);

        foreach ($this->getOperators($definition) as $operator) {
            // Skip operators without tests
            if (! $operator->tests) {
                continue;
            }

            try {
                $this->writeFile($this->createClass($definition, $operator, $dataNamespace->getClasses()[self::DATA_CLASS]), false);
            } catch (Throwable $e) {
                throw new RuntimeException(sprintf('Failed to generate class for operator "%s"', $operator->name), 0, $e);
            }
        }

        $this->writeFile($dataNamespace);
    }

    public function createExpectedClass(GeneratorDefinition $definition): PhpNamespace
    {
        $dataNamespace = str_replace('MongoDB', 'MongoDB\\Tests', $definition->namespace);

        $namespace = new PhpNamespace($dataNamespace);
        $class = $namespace->addClass(self::DATA_CLASS);
        $class->setFinal();

        return $namespace;
    }

    public function createClass(GeneratorDefinition $definition, OperatorDefinition $operator, ClassType $dataClass): PhpNamespace
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
        $class->setComment('Test ' . $operator->name . ' ' . basename($definition->configFiles));

        foreach ($operator->tests as $test) {
            $testName = str_replace(' ', '', ucwords(str_replace('$', '', $test->name)));
            $constName = str_replace(' ', '_', strtoupper(str_replace('$', '', $operator->name . ' ' . $test->name)));

            $constant = $dataClass->addConstant($constName, new Literal('<<<\'JSON\'' . "\n" . json_encode($test->pipeline, JSON_PRETTY_PRINT) . "\n" . 'JSON'));
            if ($test->link) {
                $constant->setComment('@see ' . $test->link);
            }

            $constName = self::DATA_CLASS . '::' . $constName;

            if ($class->hasMethod('test' . $testName)) {
                $testMethod = $class->getMethod('test' . $testName);
            } else {
                $testMethod = $class->addMethod('test' . $testName);
                $testMethod->setBody(<<<PHP
                \$pipeline = new Pipeline();

                \$this->assertSamePipeline({$constName}, \$pipeline);
                PHP);
            }

            $testMethod->setPublic();
            $testMethod->setReturnType(Type::Void);
        }

        $methods = $class->getMethods();
        ksort($methods);
        $class->setMethods($methods);

        return $namespace;
    }
}
