<?php

namespace qK1e\Overloading;

use qK1e\Overloading\Comparators\BasicComparator;
use qK1e\Overloading\Comparators\FalseConstantComparator;
use qK1e\Overloading\Comparators\IComparator;
use qK1e\Overloading\Comparators\NullComparator;
use qK1e\Overloading\Comparators\ObjectComparator;

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