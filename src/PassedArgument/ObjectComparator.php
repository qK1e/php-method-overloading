<?php

namespace qK1e\Overloading\PassedArgument;

class ObjectComparator implements IComparator
{
    public function __construct(private readonly object $argument) {}

    public function sameType(\ReflectionNamedType $type): bool
    {
        return is_a($this->argument, $type->getName(), true);
    }
}