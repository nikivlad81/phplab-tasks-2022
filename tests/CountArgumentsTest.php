<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsTest extends TestCase
{
    protected \functions\Functions $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    /**
     * @dataProvider positiveDataProvider
     */
    public function testCountArguments($expected, $arg)
    {
        $this->assertEquals($expected, $this->functions->countArguments(...$arg));
    }

    public function positiveDataProvider(): array
    {
        return array(
            array(['argument_count'=> 0,'argument_values'=>[]], []),
            array(['argument_count'=> 1,'argument_values'=>['string']], ['string']),
            array(['argument_count'=> 2,'argument_values'=>['string','string2']], ['string','string2'])
        );
    }
}