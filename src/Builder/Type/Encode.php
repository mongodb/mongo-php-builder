<?php

declare(strict_types=1);

namespace MongoDB\Builder\Type;

use MongoDB\Builder\BuilderEncoder;

/**
 * Defines how to encode a stage or an operator into BSON.
 *
 * @see BuilderEncoder
 */
enum Encode
{
    /**
     * Parameters are encoded as an array of values in the order they are defined by the spec and declared in the object.
     */
    case Array;

    /**
     * Parameters are encoded as an object with keys matching the parameter names
     */
    case Object;

    /**
     * Same as Object, but only parameters are returned. The operator name will not be used.
     */
    case FlatObject;

    /**
     * Parameters are encoded as an object with keys matching the parameter names prefixed with a dollar sign ($)
     */
    case DollarObject;

    /**
     * Get the single parameter value
     */
    case Single;

    /**
     * Specific for $group stage
     */
    case Group;

    /**
     * Default case used in the interface; implementing classes are expected to override this value
     */
    case Undefined;
}
