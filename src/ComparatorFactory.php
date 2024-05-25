<?php

namespace qK1e\Overloading;

use qK1e\Overloading\PassedArgument\BasicComparator;
use qK1e\Overloading\PassedArgument\FalseConstantComparator;
use qK1e\Overloading\PassedArgument\IComparator;
use qK1e\Overloading\PassedArgument\NullComparator;
use qK1e\Overloading\PassedArgument\ObjectComparator;

class ComparatorFactory
{
    public static function create(mixed $argument): IComparator
    {
        $type = gettype($argument);

        return match ($type) {
            'boolean',
            'integer',
            'string',
            'double',
            'array' => new BasicComparator($argument),
            'object' => new ObjectComparator($argument),
            'NULL' => new NullComparator(),
            default => new FalseConstantComparator(),
        };
    }
}