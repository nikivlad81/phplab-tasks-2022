<?php

use PHPUnit\Framework\TestCase;

class SayHelloTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, $this->functions->sayHello($input));
    }

    public function positiveDataProvider(): array
    {
        return [
            ['', 'Hello'],
            ['Hello', 'Hello'],
            ['Bye', 'Hello'],
        ];
    }
}