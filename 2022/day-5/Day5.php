<?php

declare(strict_types=1);

final class Day5
{
    private const MAPPING = [
        1 => 1,
        5 => 2,
        9 => 3,
        13 => 4,
        17 => 5,
        21 => 6,
        25 => 7,
        29 => 8,
        33 => 9,
    ];

    private const MAX_HEIGHT = 8;

    public function __construct()
    {
        var_dump($this->calculate());
    }

    private function calculate(): string
    {
        $handle = fopen("input.txt", "rb");
        $code = "";
        $cargo = [];
        $currentHeight = 0;

        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $line = trim($line);

                preg_match_all('/[\w+]/', $line, $matches);

                // Pour external crates into intern format
                if ($currentHeight < self::MAX_HEIGHT) {
                    foreach ($matches[0] as $crate) {
                        $stringLocation = strpos($line, $crate);
                        $crateColumn = self::MAPPING[$stringLocation];
                        $cargo[$crateColumn][] = $crate;
                        $line[$stringLocation] = 0;
                    }
                    $currentHeight++;
                    continue;
                }

                // Reverse order of each column of crates
                if ($currentHeight === self::MAX_HEIGHT) {
                    foreach ($cargo as $column => $crates) {
                        $cargo[$column] = array_reverse($crates);
                    }
                    $currentHeight++;
                    continue;
                }

                // Only do movement from now on
                if (!str_starts_with($line, 'move')) {
                    continue;
                }

                $movement = explode(' ', $line);
                $amount = (int) $movement[1];
                $from = (int) $movement[3];
                $to = (int) $movement[5];

                // Move crates
                for ($i = 0; $i < $amount; $i++) {
                    $crateToMove = array_pop($cargo[$from]);
                    array_push($cargo[$to], $crateToMove);
                }
            }

            // Create code from cargo reading left to right
            for ($i = 1, $iMax = count($cargo); $i <= $iMax; $i++) {
                $code .= end($cargo[$i]);
            }

            fclose($handle);
        }

        return $code;
    }
}

new Day5();
