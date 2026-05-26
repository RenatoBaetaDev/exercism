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

class SimpleCipher
{
    public string $key;
    private string $alphabet = "abcdefghijklmnopqrstuvwxyz";
    
    public function __construct(string $key = null)
    {
        if ($key && (is_numeric($key) || strtolower($key) !== $key) || $key === '')
            throw new InvalidArgumentException();
        
        $this->key = $key ?? $this->generateRandomKey(length: 100);
    }

    public function encode(string $plainText): string
    {
        $cipherText = "";
        $plainText = strtolower($plainText);
        $chars = str_split($plainText);
        $keyLen = strlen($this->key);
        $alphabetLen = strlen($this->alphabet);
        
        foreach ($chars as $index => $char) {
            $originalPos = strpos($this->alphabet, $char);
            $shiftBy = strpos($this->alphabet, $this->key[$index % $keyLen]);
            $cipherText .= $this->alphabet[($originalPos+$shiftBy) % $alphabetLen];
        }

        return $cipherText;
    }

    public function decode(string $cipherText): string
    {
        $plainText = "";
        $chars = str_split($cipherText);
        $keyLen = strlen($this->key);
        $alphabetLen = strlen($this->alphabet);
        
        foreach ($chars as $index => $char) {
            $cipherPos = strpos($this->alphabet, $char);
            $unshiftBy = strpos($this->alphabet, $this->key[$index % $keyLen]);
            $plainText .= $this->alphabet[($cipherPos-$unshiftBy) % $alphabetLen];
        }
        
        return $plainText;
    }

    private function generateRandomKey(int $length): string
    {
        $alphabetLen = strlen($this->alphabet);
        $key = "";
        
        for ($i = 0; $i < $length; $i++)
        {
            $index = rand(0, $alphabetLen - 1);
            $key .= $this->alphabet[$index];
        }

        return $key;
    }
}
