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
use MongoDB\Builder\Type\Optional;
use MongoDB\Builder\Type\QueryInterface;
use MongoDB\Builder\Type\Sort;
use MongoDB\CodeGenerator\Definition\GeneratorDefinition;
use MongoDB\Model\BSONArray;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Method;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\TraitType;
use RuntimeException;
use stdClass;
use Throwable;

use function array_key_last;
use function array_map;
use function assert;
use function implode;
use function sprintf;

/**
 * Generates a fluent factory class for aggregation pipeline stages.
 * The method definition is based on the manually edited static class
 * that imports the stage factory trait.
 */
class FluentStageFactoryGenerator extends OperatorGenerator
{
    /**
     * All public of this class are duplicated as instance methods of the
     * fluent factory class.
     */
    private const FACTORY_CLASS = Stage::class;

    public function generate(GeneratorDefinition $definition): void
    {
        $this->writeFile($this->createFluentFactoryClass($definition));
    }

    private function createFluentFactoryClass(GeneratorDefinition $definition): PhpNamespace
    {
        $namespace = new PhpNamespace($definition->namespace);
        $class = $namespace->addClass('FluentFactory');

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
            ->setValue([]);
        $class->addMethod('getPipeline')
            ->setReturnType(Pipeline::class)
            ->setBody(<<<'PHP'
                return new Pipeline(...$this->pipeline);
                PHP);

        $staticFactory = ClassType::from(self::FACTORY_CLASS);
        assert($staticFactory instanceof ClassType);
        foreach ($staticFactory->getMethods() as $method) {
            if (! $method->isPublic()) {
                continue;
            }

            try {
                $this->addMethod($method, $namespace, $class);
            } catch (Throwable $e) {
                throw new RuntimeException(sprintf('Failed to generate class for operator "%s"', $operator->name), 0, $e);
            }
        }

        $staticFactory = TraitType::from(Stage\FactoryTrait::class);
        assert($staticFactory instanceof TraitType);
        foreach ($staticFactory->getMethods() as $method) {
            if (! $method->isPublic()) {
                continue;
            }

            try {
                $this->addMethod($method, $namespace, $class);
            } catch (Throwable $e) {
                throw new RuntimeException(sprintf('Failed to generate class for operator "%s"', $operator->name), 0, $e);
            }
        }

        return $namespace;
    }

    private function addMethod(Method $factoryMethod, PhpNamespace $namespace, ClassType $class): void
    {
        if ($class->hasMethod($factoryMethod->getName())) {
            return;
        }

        $method = $class->addMethod($factoryMethod->getName());

        $method->setComment($factoryMethod->getComment());
        $method->setParameters($factoryMethod->getParameters());

        $args = array_map(
            fn ($param) => '$' . $param->getName(),
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
            'Stage',
            $factoryMethod->getName(),
            implode(',', $args),
        ));
    }
}
