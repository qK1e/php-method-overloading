<?php

namespace qK1e\Overloading\Comparators;

class FalseConstantComparator implements IComparator
{
    public function sameType(\ReflectionNamedType $type): bool
    {
        return false;
    }
}