<?php

declare(strict_types=1);

namespace MongoDB\Builder\Type;

use MongoDB\Builder\Expression\ResolvesToAny;
use MongoDB\Builder\Expression\Variable as VariableExpression;

enum Variable: string implements DictionaryInterface, ResolvesToAny
{
    /**
     * A variable that returns the current datetime value.
     */
    case Now = 'NOW';

    /**
     * A variable that returns the current timestamp value.
     */
    case ClusterTime = 'CLUSTER_TIME';

    /**
     * References the root document, i.e. the top-level document, currently being processed in the aggregation pipeline stage.
     */
    case Root = 'ROOT';

    /**
     * References the start of the field path being processed in the aggregation pipeline stage.
     * Use Variable::Current->dot('field') to reference $field
     */
    case Current = 'CURRENT';

    /**
     * A variable which evaluates to the missing value. Allows for the conditional exclusion of fields. In a $project, a field set to the variable REMOVE is excluded from the output.
     */
    case Remove = 'REMOVE';

    /**
     * A variable that stores the metadata results of an Atlas Search query. In all supported aggregation pipeline
     * stages, a field set to the variable $$SEARCH_META returns the metadata results for the query.
     */
    case SearchMeta = 'SEARCH_META';

    /**
     * Returns the roles assigned to the current user.
     */
    case UserRoles = 'USER_ROLES';

    public function dot(string $name): VariableExpression
    {
        return new VariableExpression($this->value . '.' . $name);
    }

    public function getValue(): string
    {
        return '$$' . $this->value;
    }
}
