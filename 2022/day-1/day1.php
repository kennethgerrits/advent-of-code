<?php

declare(strict_types=1);

final class day1
{

    public function __construct()
    {
        var_dump($this->calculate());
    }

    private function calculate(): int
    {
        $highest = 0;
        $current = 0;
        $handle = fopen("input.txt", "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $line = trim($line);
                if (empty($line)) {
                    if ($current > $highest) {
                        $highest = $current;
                    }
                    $current = 0;
                } else {
                    $current += (int) $line;
                }
            }
            fclose($handle);
        }

        return $highest;
    }

}

new day1();
