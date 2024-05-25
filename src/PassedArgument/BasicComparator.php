<?php

namespace qK1e\Overloading\PassedArgument;

class BasicComparator implements IComparator
{
    private string $passedType;

    public function __construct(int|float|string|bool $value) {
        $this->passedType = gettype($value);
    }

    public function sameType(\ReflectionNamedType $type): bool
    {
        if ($this->passedType === "integer") {
            return $type->getName() === "int";
        }

        if ($this->passedType === "double") {
            return $type->getName() === "float";
        }

        if ($this->passedType === "boolean") {
            return $type->getName() === "bool";
        }

        return $this->passedType === $type->getName();
    }
}