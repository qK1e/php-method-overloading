<?php

namespace qK1e\Overloading;

use Closure;

class Call
{
    /**
     * @param Closure[]|callable[] $functions
     */
    public static function firstFit(array $functions, $args, $context)
    {
        foreach ($functions as $function) {
            if ((new CandidateFunction($function))->signatureFits($args)) {
                return $function->call($context, ...$args);
            }
        }

        throw new SignatureException("Not function fits passed arguments");
    }
}