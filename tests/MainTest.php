<?php

use PHPUnit\Framework\TestCase;
use qK1e\Overloading\Call;
use qK1e\Overloading\SignatureException;

class MainTest extends TestCase
{
    public function testSkipsFirstCandidate()
    {
        $this->assertEquals(
            'intCandidate',
            $this->overloaded(1)
        );
    }

    public function testPassedByName()
    {
        $this->assertEquals(
            "passed",
            $this->overloaded(true, c: "passed")
        );
    }

    /**
     * @throws SignatureException
     */
    private function overloaded(...$args) {
        return Call::firstFit([
            $this->stringCandidate(...),
            $this->intCandidate(...),
            $this->threeArgsCandidate(...)
        ], $args, $this);
    }

    private function intCandidate(int $arg): string
    {
        return __FUNCTION__;
    }

    private function stringCandidate(string $string): string
    {
        return __FUNCTION__;
    }

    private function threeArgsCandidate(bool $a, bool $b = true, string $c = "default"): string
    {
        return $c;
    }
}