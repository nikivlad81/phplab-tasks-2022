<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($arg, $expected)
    {
        $this->assertEquals($expected, $this->functions->sayHelloArgument($arg));
    }

    public function positiveDataProvider(): array
    {
        return [
            [32, 'Hello 32'],
            ['World', 'Hello World'],
            [true, 'Hello 1'],
        ];
    }
}