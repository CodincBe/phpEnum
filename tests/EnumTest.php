<?php

namespace Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Class EnumTest
 *
 * @package Tests
 */
class EnumTest extends TestCase
{
    /**
     * @test
     */
    public function instantiation()
    {
        $this->assertEquals(Example::FIRST, (string) Example::FIRST());
    }

    /**
     * @test
     */
    public function comparison()
    {
        $first = Example::FIRST();
        $second = Example::SECOND();

        $this->assertSame($first, Example::FIRST());
        $this->assertNotSame($first, $second);
    }

    /**
     * @test
     */
    public function autocompletionCheck()
    {
        $this->assertSame(Example::THIRD(), Example::THIRD());
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage ten is not supported by Tests\Example
     */
    public function failureNonExisting()
    {
        Example::load('ten');
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Four is not supported by Tests\Example
     */
    public function failureCasing()
    {
        Example::load('Four');
    }

    /**
     * @test
     */
    public function typeSafety()
    {
        $this->assertNotSame(Example::FIRST(), MyEnum::FIRST());
        $this->assertSame(MyEnum::PERSONAL(), MyEnum::PERSONAL(), 'Make sure loading a second Enum gets populated as well');
    }
}
