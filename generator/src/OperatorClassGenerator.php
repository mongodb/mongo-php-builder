<?php

declare(strict_types=1);

namespace MongoDB\CodeGenerator;

use MongoDB\BSON\Javascript;
use MongoDB\Builder\Type\Encode;
use MongoDB\Builder\Type\OperatorInterface;
use MongoDB\Builder\Type\QueryObject;
use MongoDB\CodeGenerator\Definition\GeneratorDefinition;
use MongoDB\CodeGenerator\Definition\OperatorDefinition;
use MongoDB\CodeGenerator\Definition\VariadicType;
use MongoDB\Exception\InvalidArgumentException;
use Nette\PhpGenerator\Literal;
use Nette\PhpGenerator\PhpNamespace;
use RuntimeException;
use stdClass;
use Throwable;

use function assert;
use function interface_exists;
use function rtrim;
use function sprintf;
use function var_export;

/**
 * Generates a value object class for stages and operators.
 */
class OperatorClassGenerator extends OperatorGenerator
{
    public function generate(GeneratorDefinition $definition): void
    {
        foreach ($this->getOperators($definition) as $operator) {
            try {
                $this->writeFile($this->createClass($definition, $operator));
            } catch (Throwable $e) {
                throw new RuntimeException(sprintf('Failed to generate class for operator "%s"', $operator->name), 0, $e);
            }
        }
    }

    public function createClass(GeneratorDefinition $definition, OperatorDefinition $operator): PhpNamespace
    {
        $namespace = new PhpNamespace($definition->namespace);

        $interfaces = $this->getInterfaces($operator);
        foreach ($interfaces as $interface) {
            $namespace->addUse($interface);
        }

        $class = $namespace->addClass($this->getOperatorClassName($definition, $operator));
        $class->setImplements($interfaces);
        $namespace->addUse(OperatorInterface::class);
        $class->addImplement(OperatorInterface::class);

        // Expose operator metadata as constants
        // @todo move to encoder class
        $class->addComment($operator->description);
        $class->addComment('@see ' . $operator->link);
        $namespace->addUse(Encode::class);
        $class->addConstant('ENCODE', new Literal('Encode::' . $operator->encode->name));

        $constuctor = $class->addMethod('__construct');
        foreach ($operator->arguments as $argument) {
            $type = $this->getAcceptedTypes($argument);
            foreach ($type->use as $use) {
                $namespace->addUse($use);
            }

            $property = $class->addProperty($argument->name);
            $property->setReadOnly();
            $constuctorParam = $constuctor->addParameter($argument->name);
            $constuctorParam->setType($type->native);

            if ($argument->variadic) {
                $constuctor->setVariadic();
                $constuctor->addComment('@param ' . $type->doc . ' ...$' . $argument->name . rtrim(' ' . $argument->description));

                if ($argument->variadicMin > 0) {
                    $constuctor->addBody(<<<PHP
                    if (\count(\${$argument->name}) < {$argument->variadicMin}) {
                        throw new InvalidArgumentException(\sprintf('Expected at least %d values for \${$argument->name}, got %d.', {$argument->variadicMin}, \count(\${$argument->name})));
                    }

                    PHP);
                }

                if ($argument->variadic === VariadicType::Array) {
                    $property->setType('array');
                    $property->addComment('@var list<' . $type->doc . '> $' . $argument->name . rtrim(' ' . $argument->description));
                    // Warn that named arguments are not supported
                    // @see https://psalm.dev/docs/running_psalm/issues/NamedArgumentNotAllowed/
                    $constuctor->addComment('@no-named-arguments');
                    $namespace->addUseFunction('array_is_list');
                    $namespace->addUse(InvalidArgumentException::class);
                    $constuctor->addBody(<<<PHP
                    if (! array_is_list(\${$argument->name})) {
                        throw new InvalidArgumentException('Expected \${$argument->name} arguments to be a list (array), named arguments are not supported');
                    }

                    PHP);
                } elseif ($argument->variadic === VariadicType::Object) {
                    $namespace->addUse(stdClass::class);
                    $property->setType(stdClass::class);
                    $property->addComment('@var stdClass<' . $type->doc . '> $' . $argument->name . rtrim(' ' . $argument->description));
                    $namespace->addUseFunction('is_string');
                    $namespace->addUse(InvalidArgumentException::class);
                    $constuctor->addBody(<<<PHP
                    foreach(\${$argument->name} as \$key => \$value) {
                        if (! is_string(\$key)) {
                            throw new InvalidArgumentException('Expected \${$argument->name} arguments to be a map (object), named arguments (<name>:<value>) or array unpacking ...[\'<name>\' => <value>] must be used');
                        }
                    }

                    \${$argument->name} = (object) \${$argument->name};
                    PHP);
                }
            } else {
                // Non-variadic arguments
                $property->addComment('@var ' . $type->doc . ' $' . $argument->name . rtrim(' ' . $argument->description));
                $property->setType($type->native);
                $constuctor->addComment('@param ' . $type->doc . ' $' . $argument->name . rtrim(' ' . $argument->description));

                if ($argument->optional) {
                    // We use a special Optional::Undefined type to differentiate between null and undefined
                    $constuctorParam->setDefaultValue(new Literal('Optional::Undefined'));
                } elseif ($argument->default !== null) {
                    $constuctorParam->setDefaultValue($argument->default);
                }

                // List type must be validated with array_is_list()
                if ($type->list) {
                    $namespace->addUseFunction('is_array');
                    $namespace->addUseFunction('array_is_list');
                    $namespace->addUse(InvalidArgumentException::class);
                    $constuctor->addBody(<<<PHP
                    if (is_array(\${$argument->name}) && ! array_is_list(\${$argument->name})) {
                        throw new InvalidArgumentException('Expected \${$argument->name} argument to be a list, got an associative array.');
                    }

                    PHP);
                }

                if ($type->query) {
                    $namespace->addUseFunction('is_array');
                    $namespace->addUse(QueryObject::class);
                    $constuctor->addBody(<<<PHP
                    if (is_array(\${$argument->name})) {
                        \${$argument->name} = QueryObject::create(\${$argument->name});
                    }

                    PHP);
                }

                if ($type->javascript) {
                    $namespace->addUseFunction('is_string');
                    $namespace->addUse(Javascript::class);
                    $constuctor->addBody(<<<PHP
                    if (is_string(\${$argument->name})) {
                        \${$argument->name} = new Javascript(\${$argument->name});
                    }

                    PHP);
                }
            }

            // Set property from constructor argument
            $constuctor->addBody('$this->' . $argument->name . ' = $' . $argument->name . ';');
        }

        $class->addMethod('getOperator')
            ->setReturnType('string')
            ->setBody('return ' . var_export($operator->name, true) . ';');

        return $namespace;
    }

    /**
     * Operator classes interfaces are defined by their return type as a MongoDB expression.
     *
     * @return list<class-string>
     */
    private function getInterfaces(OperatorDefinition $definition): array
    {
        $interfaces = [];

        foreach ($definition->type as $type) {
            $interfaces[] = $interface = $this->getType($type)->returnType;
            assert(interface_exists($interface), sprintf('"%s" is not an interface.', $interface));
        }

        return $interfaces;
    }
}
