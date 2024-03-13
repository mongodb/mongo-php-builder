<?php

declare(strict_types=1);

namespace MongoDB\CodeGenerator;

use MongoDB\Builder\Pipeline;
use MongoDB\Builder\Stage;
use MongoDB\Builder\Type\StageInterface;
use MongoDB\CodeGenerator\Definition\GeneratorDefinition;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Method;
use Nette\PhpGenerator\Parameter;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\TraitType;
use ReflectionClass;

use function array_key_last;
use function array_map;
use function assert;
use function file_get_contents;
use function implode;
use function sprintf;

/**
 * Generates a fluent factory class for aggregation pipeline stages.
 * The method definition is based on all the public static methods
 * of the Stage class.
 */
class FluentStageFactoryGenerator extends OperatorGenerator
{
    private const FACTORY_CLASS = Stage::class;

    public function generate(GeneratorDefinition $definition): void
    {
        $this->writeFile($this->createFluentFactoryClass($definition));
    }

    private function createFluentFactoryClass(GeneratorDefinition $definition): PhpNamespace
    {
        $namespace = new PhpNamespace($definition->namespace);
        $class = $namespace->addClass('FluentFactory');

        $namespace->addUse(self::FACTORY_CLASS);
        $namespace->addUse(StageInterface::class);
        $namespace->addUse(Pipeline::class);

        $class->addProperty('pipeline')
            ->setType('array')
            ->setComment('@var list<StageInterface>')
            ->setValue([]);
        $class->addMethod('getPipeline')
            ->setReturnType(Pipeline::class)
            ->setBody(<<<'PHP'
                return new Pipeline(...$this->pipeline);
                PHP);

        $this->addUsesFrom(self::FACTORY_CLASS, $namespace);
        $staticFactory = ClassType::from(self::FACTORY_CLASS);
        assert($staticFactory instanceof ClassType);

        // Import the methods customized in the factory class
        foreach ($staticFactory->getMethods() as $method) {
            $this->addMethod($method, $class);
        }

        // Import the other methods provided by the generated trait
        foreach ($staticFactory->getTraits() as $trait) {
            $this->addUsesFrom($trait->getName(), $namespace);
            $staticFactory = TraitType::from($trait->getName());
            assert($staticFactory instanceof TraitType);
            foreach ($staticFactory->getMethods() as $method) {
                $this->addMethod($method, $class);
            }
        }

        return $namespace;
    }

    private function addMethod(Method $factoryMethod, ClassType $class): void
    {
        // Non-public methods are not part of the API
        if (! $factoryMethod->isPublic()) {
            return;
        }

        // Some methods can be overridden in the class, so we skip them
        // when importing the methods provided by the trait.
        if ($class->hasMethod($factoryMethod->getName())) {
            return;
        }

        $method = $class->addMethod($factoryMethod->getName());

        $method->setComment($factoryMethod->getComment());
        $method->setParameters($factoryMethod->getParameters());

        $args = array_map(
            fn (Parameter $param): string => '$' . $param->getName(),
            $factoryMethod->getParameters(),
        );

        if ($factoryMethod->isVariadic()) {
            $method->setVariadic();
            $args[array_key_last($args)] = '...' . $args[array_key_last($args)];
        }

        $method->setReturnType('static');
        $method->setBody(sprintf(
            <<<'PHP'
            $this->pipeline[] = %s::%s(%s);

            return $this;
            PHP,
            (new ReflectionClass(self::FACTORY_CLASS))->getShortName(),
            $factoryMethod->getName(),
            implode(', ', $args),
        ));
    }

    private static function addUsesFrom(string $class, PhpNamespace $namespace): void
    {
        $file = PhpFile::fromCode(file_get_contents((new ReflectionClass($class))->getFileName()));

        foreach ($file->getNamespaces() as $ns) {
            foreach ($ns->getUses() as $use) {
                $namespace->addUse($use);
            }
        }
    }
}
