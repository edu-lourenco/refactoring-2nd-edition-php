<?php

namespace App;

class PizzaBuilder
{
    private string $size = 'Medium';
    private bool $cheese = false;
    private bool $peperoni = false;
    private bool $tomato = false;
    private bool $onion = false;

    public function addCheese(): self
    {
        $this->cheese = true;
        return $this;
    }

    public function size(string $size): self
    {
        $this->size = $size;
        return $this;
    }

    public function addPeperoni(): self
    {
        $this->peperoni = true;
        return $this;
    }

    public function addTomato(): self
    {
        $this->tomato = true;
        return $this;
    }

    public function addOnion(): self
    {
        $this->tomato = true;
        return $this;
    }

    public function builder()
    {
        return new Pizza($this->size, $this->cheese, $this->peperoni, $this->tomato, $this->onion);
    }
}