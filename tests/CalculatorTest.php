<?php

use App\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{

    /**
     * @dataProvider numbersDataProvider
     * @test
     */
    public function it_should_do_a_sum_and_return_the_result($number1, $number2, $expected)
    {
        $sum = new Calculator();
        $result = $sum->sum($number1, $number2);
        $this->assertEquals($expected, $result);
    }

    public function numbersDataProvider(): array
    {
        return [
            [10, 20, 30],
            [1.5, 10, 11.5],
            [-10, 20, 10],
            [1, -20, -19],
            [1.8, 1.8, 3.6],
        ];
    }
}
