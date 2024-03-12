<?php

declare(strict_types=1);

namespace MongoDB\CodeGenerator;

use MongoDB\BSON\Decimal128;
use MongoDB\BSON\Document;
use MongoDB\BSON\Int64;
use MongoDB\BSON\PackedArray;
use MongoDB\BSON\Serializable;
use MongoDB\BSON\Timestamp;
use MongoDB\BSON\Type;
use MongoDB\Builder\Expression\ArrayFieldPath;
use MongoDB\Builder\Expression\FieldPath;
use MongoDB\Builder\Expression\ResolvesToArray;
use MongoDB\Builder\Expression\ResolvesToObject;
use MongoDB\Builder\Pipeline;
use MongoDB\Builder\Stage;
use MongoDB\Builder\Type\AccumulatorInterface;
use MongoDB\Builder\Type\ExpressionInterface;
use MongoDB\Builder\Type\FieldQueryInterface;
use MongoDB\Builder\Type\Optional;
use MongoDB\Builder\Type\QueryInterface;
use MongoDB\Builder\Type\Sort;
use MongoDB\Builder\Type\StageInterface;
use MongoDB\CodeGenerator\Definition\GeneratorDefinition;
use MongoDB\Model\BSONArray;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Method;
use Nette\PhpGenerator\Parameter;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\TraitType;
use ReflectionClass;
use stdClass;

use function array_key_last;
use function array_map;
use function assert;
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

        $namespace->addUse(StageInterface::class);
        $namespace->addUse(FieldQueryInterface::class);
        $namespace->addUse(Pipeline::class);
        $namespace->addUse(Decimal128::class);
        $namespace->addUse(Document::class);
        $namespace->addUse(Int64::class);
        $namespace->addUse(PackedArray::class);
        $namespace->addUse(Serializable::class);
        $namespace->addUse(Timestamp::class);
        $namespace->addUse(Type::class);
        $namespace->addUse(ArrayFieldPath::class);
        $namespace->addUse(FieldPath::class);
        $namespace->addUse(ResolvesToArray::class);
        $namespace->addUse(ResolvesToObject::class);
        $namespace->addUse(Pipeline::class);
        $namespace->addUse(AccumulatorInterface::class);
        $namespace->addUse(ExpressionInterface::class);
        $namespace->addUse(Optional::class);
        $namespace->addUse(QueryInterface::class);
        $namespace->addUse(Sort::class);
        $namespace->addUse(BSONArray::class);
        $namespace->addUse(stdClass::class);
        $namespace->addUse(self::FACTORY_CLASS);
        $class->addProperty('pipeline')
            ->setType('array')
            ->setComment('@var list<StageInterface>')
            ->setValue([]);
        $class->addMethod('getPipeline')
            ->setReturnType(Pipeline::class)
            ->setBody(<<<'PHP'
                return new Pipeline(...$this->pipeline);
                PHP);

        $staticFactory = ClassType::from(self::FACTORY_CLASS);
        assert($staticFactory instanceof ClassType);

        // Import the methods customized in the factory class
        foreach ($staticFactory->getMethods() as $method) {
            if (! $method->isPublic()) {
                continue;
            }

            $this->addMethod($method, $class);
        }

        // Import the other methods provided by the generated trait
        foreach ($staticFactory->getTraits() as $trait) {
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
}
