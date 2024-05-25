<?php

namespace qK1e\Overloading\PassedArgument;

class NullComparator implements IComparator
{
    public function __construct() {}

    public function sameType(\ReflectionNamedType $type): bool
    {
        return $type->allowsNull();
    }
}