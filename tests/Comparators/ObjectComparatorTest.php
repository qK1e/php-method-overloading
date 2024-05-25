<?php

namespace Comparators;

use PHPUnit\Framework\TestCase;
use qK1e\Overloading\PassedArgument\ObjectComparator;
use ReflectionFunction;
use tests\AbstractClass;
use tests\AbstractClassExtended;
use tests\EmptyClass1;
use tests\EmptyClass2;
use tests\EmptyInterface1;
use tests\Extendedinterface;
use tests\WithExtendedInterface;
use tests\WithInterface1;

class ObjectComparatorTest extends TestCase
{
    public function testClass() {
        $sut = new ObjectComparator(new EmptyClass1());

        $this->assertTrue($sut->sameType($this->EmptyClass1()));
        $this->assertFalse($sut->sameType($this->EmptyClass2()));
    }

    public function testInterface() {
        $sut = new ObjectComparator(new WithInterface1());

        $this->assertTrue($sut->sameType($this->EmptyInterface1()));
        $this->assertFalse($sut->sameType($this->EmptyClass1()));
    }

    public function testExtendedInterfaceParent() {
        $sut = new ObjectComparator(new WithExtendedInterface());

        $this->assertTrue($sut->sameType($this->ExtendedInterface()));
        $this->assertTrue($sut->sameType($this->EmptyInterface1()));
        $this->assertFalse($sut->sameType($this->EmptyClass1()));
    }

    public function testAbstractClass() {
        $sut = new ObjectComparator(new AbstractClassExtended());

        $this->assertTrue($sut->sameType($this->AbstractClass()));
        $this->assertFalse($sut->sameType($this->EmptyClass1()));
    }

    private function EmptyClass1(EmptyClass1 $arg = new EmptyClass1()): \ReflectionNamedType
    {
        return $this->getReflectionParams(__FUNCTION__);
    }

    private function EmptyClass2(EmptyClass2 $arg = new EmptyClass2()): \ReflectionNamedType
    {
        return $this->getReflectionParams(__FUNCTION__);
    }

    private function EmptyInterface1(EmptyInterface1 $arg = new WithInterface1()): \ReflectionNamedType
    {
        return $this->getReflectionParams(__FUNCTION__);
    }

    private function ExtendedInterface(ExtendedInterface $arg = new WithExtendedInterface()): \ReflectionNamedType
    {
        return $this->getReflectionParams(__FUNCTION__);
    }

    private function AbstractClass(AbstractClass $arg = new AbstractClassExtended()): \ReflectionNamedType
    {
        return $this->getReflectionParams(__FUNCTION__);
    }

    private function getReflectionParams(string $functionName): \ReflectionNamedType
    {
        $reflectionFunc = new ReflectionFunction($this->$functionName(...));

        return $reflectionFunc->getParameters()[0]->getType();
    }
}


