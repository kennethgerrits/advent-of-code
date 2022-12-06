<?php

declare(strict_types=1);

final class Day1
{
    public function __construct()
    {
        $this->calculate();
    }

    private function calculate(): void
    {
        $mostCalories = [];
        $current = 0;
        $handle = fopen("input.txt", "r");

        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $line = trim($line);
                if (empty($line)) {
                    if (count($mostCalories) < 3) {
                        $mostCalories[] = $current;
                        $current = 0;
                        continue;
                    }

                    $lowestCaloriesInArray = min($mostCalories);
                    if ($current > $lowestCaloriesInArray) {
                        $lowestCaloriesInArrayKey = array_search($lowestCaloriesInArray, $mostCalories, true);
                        $mostCalories[$lowestCaloriesInArrayKey] = $current;
                    }

                    $current = 0;
                } else {
                    $current += (int) $line;
                }
            }

            fclose($handle);
        }

        var_dump(array_sum($mostCalories));
    }
}

new Day1();
