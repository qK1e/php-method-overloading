<?php

namespace qK1e\Overloading\Comparators;

interface IComparator
{
    public function sameType(\ReflectionNamedType $type): bool;
}