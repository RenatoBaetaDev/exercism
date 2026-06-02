<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types=1);

class ResistorColorTrio
{
    private array $resistorsResistence = [
        "black" => 0,
        "brown" => 1,
        "red" => 2,
        "orange" => 3,
        "yellow" => 4,
        "green" => 5,
        "blue" => 6,
        "violet" => 7,
        "grey" => 8,
        "white" => 9
    ];
    
    public function label(array $resistors): string
    {
        [$color1, $color2, $zeroes] = $resistors;

        $resistence = (string) $this->resistorsResistence[$color1] . (string) $this->resistorsResistence[$color2];
                
        $resistence = $resistence * (10 ** $this->resistorsResistence[$zeroes]);

        $howManyZeroes = substr_count( (string) $resistence, "0");

        return match(true) {
            $howManyZeroes < 2 => $resistence . " ohms",
            $howManyZeroes < 5 => ($resistence / (10 ** ($howManyZeroes > 3 ? 3 : $howManyZeroes)))  . " kiloohms",
            $howManyZeroes < 8 => ($resistence / (10 ** ($howManyZeroes > 6 ? 6 : $howManyZeroes))) . " megaohms",
            $howManyZeroes < 12 => ($resistence / (10 ** $howManyZeroes)) . " gigaohms",
        };
    }
}
