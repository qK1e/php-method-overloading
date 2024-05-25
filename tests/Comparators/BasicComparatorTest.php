<?php

namespace Comparators;

use PHPUnit\Framework\TestCase;
use qK1e\Overloading\PassedArgument\BasicComparator;
use ReflectionFunction;
use ReflectionNamedType;

class BasicComparatorTest extends TestCase
{
    public function testInt()
    {
        $sut = new BasicComparator(1);

        $this->assertTrue($sut->sameType($this->int()));
        $this->assertFalse($sut->sameType($this->float()));
        $this->assertFalse($sut->sameType($this->string()));
        $this->assertFalse($sut->sameType($this->bool()));
    }

    public function testString()
    {
        $sut = new BasicComparator("1");

        $this->assertFalse($sut->sameType($this->int()));
        $this->assertFalse($sut->sameType($this->float()));
        $this->assertTrue($sut->sameType($this->string()));
        $this->assertFalse($sut->sameType($this->bool()));
    }

    public function testFloat()
    {
        $sut = new BasicComparator(.1);

        $this->assertFalse($sut->sameType($this->int()));
        $this->assertTrue($sut->sameType($this->float()));
        $this->assertFalse($sut->sameType($this->string()));
        $this->assertFalse($sut->sameType($this->bool()));
    }

    public function testBool()
    {
        $sut = new BasicComparator(true);

        $this->assertFalse($sut->sameType($this->int()));
        $this->assertFalse($sut->sameType($this->float()));
        $this->assertFalse($sut->sameType($this->string()));
        $this->assertTrue($sut->sameType($this->bool()));
    }

    private function int(int $arg = 1): \ReflectionNamedType
    {
        return $this->getReflectionParams(__FUNCTION__);
    }

    private function float(float $arg = .1): ReflectionNamedType
    {
        return $this->getReflectionParams(__FUNCTION__);
    }

    private function string(string $arg = "1"): ReflectionNamedType
    {
        return $this->getReflectionParams(__FUNCTION__);
    }

    private function bool(bool $arg = true): ReflectionNamedType
    {
        return $this->getReflectionParams(__FUNCTION__);
    }

    private function getReflectionParams(string $functionName): ReflectionNamedType
    {
        $reflectionFunc = new ReflectionFunction($this->$functionName(...));

        return $reflectionFunc->getParameters()[0]->getType();
    }
}

