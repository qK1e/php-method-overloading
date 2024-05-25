<?php

use PHPUnit\Framework\TestCase;
use qK1e\Overloading\CandidateFunction;
use tests\EmptyClass2;
use tests\EmptyClass1;

class CandidateFunctionTest extends TestCase
{
    public function testClass_passedByPosition() {
        $sut = new CandidateFunction($this->EmptyClass(...));

        $this->assertTrue(
            $sut->signatureFits(
                $this->arguments(new EmptyClass1())
            )
        );

        $this->assertFalse(
            $sut->signatureFits(
                $this->arguments(new EmptyClass2())
            )
        );
    }

    public function testClass_passedByName() {
        $sut = new CandidateFunction($this->EmptyClass(...));

        $this->assertTrue(
            $sut->signatureFits(
                $this->arguments(a: new EmptyClass1())
            )
        );

        $this->assertFalse(
            $sut->signatureFits(
                $this->arguments(b: new EmptyClass2())
            )
        );
    }

    public function testWithVariadicArgument()
    {
        $sut = new CandidateFunction($this->withVariadicInt(...));

        $this->assertTrue(
            $sut->signatureFits(
                $this->arguments(1, 2, 3, 4)
            )
        );

        $this->assertFalse(
            $sut->signatureFits(
                $this->arguments(1, 2, 3, "a")
            )
        );
    }

    private function arguments(...$args) {
        return $args;
    }

    private function EmptyClass(EmptyClass1 $a) {}

    private function withVariadicInt(int $a, int $b, int ...$c) {}
}