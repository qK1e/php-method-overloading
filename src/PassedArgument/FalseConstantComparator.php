<?php

namespace qK1e\Overloading\PassedArgument;

class FalseConstantComparator implements IComparator
{
    public function sameType(\ReflectionNamedType $type): bool
    {
        return false;
    }
}