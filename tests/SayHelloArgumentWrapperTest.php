<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentWrapperTest extends TestCase
{
    protected \functions\Functions $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    /**
     * @dataProvider provideDataForException
     */
    public function testPositive($arg)
    {
        $this->expectExceptionMessage('Entered value is not: number, string or bool');
        $this->expectException(InvalidArgumentException::class);
        $this->functions->sayHelloArgumentWrapper($arg);
    }

    public function provideDataForException(): array
    {
        return [
            array([]),
            [null],
            [new class {}],
        ];
    }
}