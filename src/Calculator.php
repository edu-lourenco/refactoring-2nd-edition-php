<?php
namespace App;

class Calculator
{
    public function Sum(int|float ... $numbers): float|int
    {
        $sum = 0;
        foreach($numbers as $number){
            $sum += $number;
        }
        return $sum;
    }
}