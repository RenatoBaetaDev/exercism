<?php

class LuckyNumbers
{
    public function sumUp(array $digitsOfNumber1, array $digitsOfNumber2): int
    {
        $num1 = (int) implode("", $digitsOfNumber1);
        $num2 = (int) implode("", $digitsOfNumber2);

        return $num1 + $num2;
    }

    public function isPalindrome(int $number): bool
    {
        return strrev((string) $number) == $number;
    }

    public function validate(string $input): string
    {
        $response = "";
        
        if (!isset($input) || $input === '' || $input === null || $input === false)
            $response = "Required field";
        else if (!((int) $input > 0))
            $response = "Must be a whole number larger than 0";

        return $response;
            
    }
}
