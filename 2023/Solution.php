<?php

declare(strict_types=1);


require_once __DIR__ . '/../helpers/FileReader.php';
use helpers\FileReader;

final class Solution
{
    private const INPUT_FILE = 'input.txt';
    private readonly FileReader $fileReader;

    public function __construct() {
        $this->fileReader = new FileReader();
    }

    public function __invoke()
    {
        foreach ($this->fileReader->read(self::INPUT_FILE) as $row) {
            var_dump($row);
        }
    }
}

(new Solution())();
