<?php

namespace qK1e\Overloading\PassedArgument;

interface IComparator
{
    public function sameType(\ReflectionNamedType $type): bool;
}