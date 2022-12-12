<?php

declare(strict_types=1);

final class Day4
{
    public function __construct()
    {
        var_dump($this->calculate());
    }

    private function calculate(): int
    {
        $handle = fopen("input.txt", "rb");
        $count = 0;

        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $line = trim($line);
                $elvesCoverage = explode(',', $line);

                $elf1 = $elvesCoverage[0];
                $elf1Range = explode('-', $elf1);
                $elf1From = (int) $elf1Range[0];
                $elf1Till = (int) $elf1Range[1];

                $elf2 = $elvesCoverage[1];
                $elf2Range = explode('-', $elf2);
                $elf2From = (int) $elf2Range[0];
                $elf2Till = (int) $elf2Range[1];

                if (($elf1From <= $elf2From && $elf1Till >= $elf2Till)
                    || ($elf1From >= $elf2From && $elf1Till <= $elf2Till)
                    || ($elf1From <= $elf2Till && $elf2From <= $elf1Till)
                    ) {
                    $count++;
                }
            }

            fclose($handle);
        }

        return $count;
    }
}

new Day4();
