<?php

declare(strict_types=1);

final class Day3
{
    public function __construct()
    {
        var_dump($this->calculate());
    }

    private function calculate(): int
    {
        $handle = fopen("input.txt", "r");
        $count = 0;

        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $line = trim($line);
                $compartmentA = str_split(substr($line, 0, strlen($line) / 2));
                $compartmentB = str_split(substr($line, strlen($line) / 2));

                $overlap = array_intersect($compartmentA, $compartmentB);
                $count += $this->getValue(array_pop($overlap));
            }

            fclose($handle);
        }

        return $count;
    }

    private function getValue(string $letter): int
    {
        $value = 0;

        if (ctype_upper($letter)) {
            $value += 26;
        }
        $value += ord(strtoupper($letter)) - ord('A') + 1;

        return $value;
    }
}

new Day3();
