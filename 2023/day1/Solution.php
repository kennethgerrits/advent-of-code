<?php

declare(strict_types=1);

namespace day1;

require_once __DIR__ . '/../helpers/FileReader.php';

use helpers\FileReader;

final class Solution
{
    private const INPUT_FILE = 'input.txt';
    private readonly FileReader $fileReader;

    public function __construct()
    {
        $this->fileReader = new FileReader();
    }

    public function __invoke()
    {
        $sum = 0;

        foreach ($this->fileReader->read(self::INPUT_FILE) as $row) {
            $charArray = str_split($row);
            $left = 0;
            $right = \count($charArray) - 1;

            while ($left < $right) {
                if (!\is_numeric($charArray[$left])) {
                    $left++;
                    continue;
                }

                if(!\is_numeric($charArray[$right])) {
                    $right--;
                    continue;
                }

                break;
            }

            $sum += (int) ($charArray[$left] . $charArray[$right]);
        }

        \var_dump($sum);
    }
}

(new Solution())();
