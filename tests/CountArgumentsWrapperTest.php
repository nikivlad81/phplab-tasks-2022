<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsWrapperTest extends TestCase
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
        $this->expectExceptionMessage('Entered value is not string');
        $this->expectException(InvalidArgumentException::class);
        $this->functions->countArgumentsWrapper($arg);
    }

    public function provideDataForException(): array
    {
        return [
            [[1, 2]],
            [['string', null]],
            [['string',1]],
            [[1,'string']],
            [['string','string2']],
        ];
    }
}