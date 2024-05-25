<?php

namespace qK1e\Overloading\Comparators;

class NullComparator implements IComparator
{
    public function __construct() {}

    public function sameType(\ReflectionNamedType $type): bool
    {
        return $type->allowsNull();
    }
}