<?php

declare(strict_types=1);

namespace MongoDB\CodeGenerator;

use MongoDB\BSON\Document;
use MongoDB\BSON\PackedArray;
use MongoDB\Builder\Type\Optional;
use MongoDB\CodeGenerator\Definition\ArgumentDefinition;
use MongoDB\CodeGenerator\Definition\ExpressionDefinition;
use MongoDB\CodeGenerator\Definition\GeneratorDefinition;
use MongoDB\CodeGenerator\Definition\OperatorDefinition;
use MongoDB\CodeGenerator\Definition\YamlReader;
use Nette\PhpGenerator\Type;
use stdClass;

use function array_filter;
use function array_key_exists;
use function array_merge;
use function array_unique;
use function assert;
use function class_exists;
use function in_array;
use function interface_exists;
use function ltrim;
use function sort;
use function sprintf;
use function ucfirst;
use function usort;

abstract class OperatorGenerator extends AbstractGenerator
{
    private YamlReader $yamlReader;

    final public function __construct(
        string $rootDir,
        /** @var array<string, ExpressionDefinition> */
        private array $expressions,
    ) {
        parent::__construct($rootDir);

        $this->yamlReader = new YamlReader();
    }

    abstract public function generate(GeneratorDefinition $definition): void;

    final protected function getOperators(GeneratorDefinition $definition): array
    {
        // Remove unsupported operators
        return array_filter(
            $this->yamlReader->read($definition->configFiles),
            fn (OperatorDefinition $operator): bool => ! in_array($operator->name, ['$'], true),
        );
    }

    final protected function getOperatorClassName(GeneratorDefinition $definition, OperatorDefinition $operator): string
    {
        return ucfirst(ltrim($operator->name, '$')) . $definition->classNameSuffix;
    }

    final protected function getType(string $type): ExpressionDefinition
    {
        assert(array_key_exists($type, $this->expressions), sprintf('Invalid expression type "%s".', $type));

        return $this->expressions[$type];
    }

    /**
     * Expression types can contain class names, interface, native types or "list".
     * PHPDoc types are more precise than native types, so we use them systematically even if redundant.
     *
     * @return object{native:string,doc:string,use:list<class-string>,list:bool,query:bool}
     */
    final protected function getAcceptedTypes(ArgumentDefinition $arg): stdClass
    {
        $nativeTypes = [];

        foreach ($arg->type as $type) {
            $type = $this->getType($type);
            $nativeTypes = array_merge($nativeTypes, $type->acceptedTypes);

            if (isset($type->returnType)) {
                $nativeTypes[] = $type->returnType;
            }
        }

        if ($arg->optional) {
            $use[] = '\\' . Optional::class;
            $nativeTypes[] = Optional::class;
        }

        $docTypes = $nativeTypes = array_unique($nativeTypes);
        $use = [];

        foreach ($nativeTypes as $key => $typeName) {
            // strings cannot be empty
            if ($typeName === 'string') {
                $docTypes[$key] = 'non-empty-string';
            }

            if (interface_exists($typeName) || class_exists($typeName)) {
                $use[] = $nativeTypes[$key] = '\\' . $typeName;
                $docTypes[$key] = $this->splitNamespaceAndClassName($typeName)[1];
                // A union cannot contain both object and a class type
                if (in_array('object', $nativeTypes, true)) {
                    unset($nativeTypes[$key]);
                }
            }
        }

        // If an array is expected, but not an object, we can check for a list
        $listCheck = in_array('\\' . PackedArray::class, $nativeTypes, true)
            && ! in_array('\\' . Document::class, $nativeTypes, true);

        // If the argument is a query, we need to convert it to a QueryObject
        $isQuery = in_array('query', $arg->type, true);

        // mixed can only be used as a standalone type
        if (in_array('mixed', $nativeTypes, true)) {
            $nativeTypes = ['mixed'];
        }

        usort($nativeTypes, self::sortTypesCallback(...));
        usort($docTypes, self::sortTypesCallback(...));
        sort($use);

        return (object) [
            'native' => Type::union(...array_unique($nativeTypes)),
            'doc' => Type::union(...array_unique($docTypes)),
            'use' => array_unique($use),
            'list' => $listCheck,
            'query' => $isQuery,
        ];
    }

    /**
     * usort() callback for sorting types.
     * "Optional" is always first, for documentation of optional parameters,
     * then types are sorted alphabetically.
     */
    private static function sortTypesCallback(string $type1, string $type2): int
    {
        if ($type1 === 'Optional' || $type1 === '\\' . Optional::class) {
            return -1;
        }

        if ($type2 === 'Optional' || $type2 === '\\' . Optional::class) {
            return 1;
        }

        return $type1 <=> $type2;
    }
}
