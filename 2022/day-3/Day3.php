<?php

declare(strict_types=1);

final class Day3
{
    private const MAX_GROUP_SIZE = 3;

    public function __construct()
    {
        var_dump($this->calculate());
    }

    private function calculate(): int
    {
        $handle = fopen("input.txt", "r");
        $count = 0;
        $groupCount = 0;
        $bags = [];

        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $line = trim($line);

                $bags[$groupCount] = str_split($line);
                $groupCount++;

                if ($groupCount === self::MAX_GROUP_SIZE) {
                    $overlap = array_intersect(...$bags);
                    $count += $this->getValue(array_pop($overlap));
                    $groupCount = 0;
                }
            }

            fclose($handle);
        }

        return $count;
    }

    private function getValue(?string $letter): int
    {
        if ($letter === null) {
            return 0;
        }

        $value = 0;

        if (ctype_upper($letter)) {
            $value += 26;
        }
        $value += ord(strtoupper($letter)) - ord('A') + 1;

        return $value;
    }
}

new Day3();
