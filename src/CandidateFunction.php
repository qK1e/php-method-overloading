<?php

namespace qK1e\Overloading;

use Closure;

class CandidateFunction
{
    private \ReflectionFunction $function;

    public function __construct(Closure $function)
    {
        $this->function = new \ReflectionFunction($function);
    }

    public function signatureFits(array $args): bool
    {
        if (count($args) < $this->function->getNumberOfRequiredParameters()) {
            return false;
        }

        $signature = $this->function->getParameters();

        $positionArgs = array_filter($args,
            function ($key) {
                return is_numeric($key);
            },
            ARRAY_FILTER_USE_KEY
        );

        $namedArgs = array_filter($args,
            function ($key) {
                return !is_numeric($key);
            },
            ARRAY_FILTER_USE_KEY
        );

        foreach ($signature as $parameter) {
            $position = $parameter->getPosition();
            $name = $parameter->getName();
            $isRequired = !$parameter->isOptional();

            $isArgPassed = isset($namedArgs[$name]) || isset($positionArgs[$position]);
            if (!$isArgPassed) {
                if ($isRequired) {
                    return false;
                }

                continue;
            }

            if (!$parameter->hasType()) {
                continue;
            }

            $type = $parameter->getType();

            if ($parameter->isVariadic()) {
                $remainingArgs = array_slice($positionArgs, $position);

                foreach ($remainingArgs as $argument) {
                    if (!$this->argOfType($argument, $type)) {
                        return false;
                    }
                }

                if (
                    isset($namedArgs[$name])
                    && !$this->argOfType($namedArgs[$name], $type)
                ) {
                    return false;
                }
            } else {
                $argument = $positionArgs[$position] ?? $namedArgs[$name];

                if (!$this->argOfType($argument, $type)) {
                    return false;
                }
            }
        }

        return true;
    }

    private function argOfType($argument, \ReflectionType $type): bool
    {
        if ($type instanceof \ReflectionNamedType) {
            if ( !ComparatorFactory::create($argument)->sameType($type) ) {
                return false;
            }

            return true;
        }

        if ($type instanceof \ReflectionUnionType) {
            foreach ($type->getTypes() as $typeCandidate) {
                if ( ComparatorFactory::create($argument)->sameType($typeCandidate) ) {
                    return true;
                }
            }

            return false;
        }

        if ($type instanceof \ReflectionIntersectionType) {
            foreach ($type->getTypes() as $typeCandidate) {
                if ( !ComparatorFactory::create($argument)->sameType($typeCandidate) ) {
                    return false;
                }
            }

            return true;
        }

        return true;
    }
}