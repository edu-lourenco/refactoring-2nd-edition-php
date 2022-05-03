<?php

namespace App;

class Pizza
{
    private string $size;
    private bool $cheese;
    private bool $peperoni;
    private bool $tomato;
    private bool $onion;

    public function __construct(string $size, bool $cheese, bool $peperoni, bool $tomato, bool $onion)
    {
        $this->size = $size;
        $this->cheese = $cheese;
        $this->peperoni = $peperoni;
        $this->tomato = $tomato;
        $this->onion = $onion;
    }
}
