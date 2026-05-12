<?php

class PizzaPi
{
    public function calculateDoughRequirement($pizzas, $persons)
    {
        return $pizzas * (($persons * 20) + 200);
    }

    public function calculateSauceRequirement($pizzas, $sauce)
    {
        return $pizzas * 125 / $sauce;
    }

    public function calculateCheeseCubeCoverage($cheese_dimension, $thickness, $diameter)
    {
        return floor(($cheese_dimension ** 3) / ($thickness * 3.14 * $diameter));
    }

    public function calculateLeftOverSlices($pizzas, $friends)
    {
        $slices = 8;
        return ($pizzas * $slices) % $friends;
    }
}
