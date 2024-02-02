<?php

declare(strict_types=1);

namespace MongoDB\Builder\Type;

use MongoDB\Builder\Expression\ResolvesToString;

enum Redact: string implements DictionaryInterface, ResolvesToString
{
    /**
     * $redact returns the fields at the current document level, excluding embedded documents. To include embedded
     * documents and embedded documents within arrays, apply the $cond expression to the embedded documents to determine
     * access for these embedded documents.
     */
    case Descend = 'DESCEND';

    /**
     * $redact excludes all fields at this current document/embedded document level, without further inspection of any
     * of the excluded fields. This applies even if the excluded field contains embedded documents that may have
     * different access levels.
     */
    case Prune = 'PRUNE';

    /**
     * $redact returns or keeps all fields at this current document/embedded document level, without further inspection
     * of the fields at this level. This applies even if the included field contains embedded documents that may have
     * different access levels.
     */
    case Keep = 'KEEP';

    public function getValue(): string
    {
        return '$$' . $this->value;
    }
}
