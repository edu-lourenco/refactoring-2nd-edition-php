<?php

namespace App;

use PHPUnit\Framework\TestCase;

class PizzaBuilderTest extends TestCase
{
    public function testShouldBuilderPizza()
    {
        $preparePizza = new PizzaBuilder();
        $preparePizza ->addCheese();
        $preparePizza ->addPeperoni();
        $preparePizza ->addTomato();
        $pizza = $preparePizza->builder();

        $this->assertInstanceOf(Pizza::class , $pizza);
    }
}
