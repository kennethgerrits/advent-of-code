<?php

declare(strict_types=1);

require_once 'Elf.php';

final class Day4
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

                $elvesCoverage = explode(',', $line);
                $elf1 = $elvesCoverage[0];
                $elf1Range = explode('-', $elf1);
                $elf1From = (int) $elf1Range[0];
                $elf1Till = (int) $elf1Range[1];
                $elf1NetSpace = $elf1Till - $elf1From;

                $elf2 = $elvesCoverage[1];
                $elf2Range = explode('-', $elf2);
                $elf2From = (int) $elf2Range[0];
                $elf2Till = (int) $elf2Range[1];
                $elf2NetSpace = $elf2Till - $elf2From;

                if ($elf1NetSpace === $elf2NetSpace && $elf1From === $elf2From && $elf1Till === $elf2Till) {
                    $count++;
                    continue;
                }

                if ($elf1NetSpace > $elf2NetSpace) {
                    $bigElf = new Elf(
                        $elf1From,
                        $elf1Till,
                        $elf1NetSpace,
                    );
                    $smallElf = new Elf(
                        $elf2From,
                        $elf2Till,
                        $elf2NetSpace,
                    );
                } else {
                    $bigElf = new Elf(
                        $elf2From,
                        $elf2Till,
                        $elf2NetSpace,
                    );
                    $smallElf = new Elf(
                        $elf1From,
                        $elf1Till,
                        $elf1NetSpace,
                    );
                }
                if ($smallElf->from >= $bigElf->from && $smallElf->till <= $bigElf->till) {
                    $count++;
                }
            }

            fclose($handle);
        }

        return $count;
    }
}

new Day4();
