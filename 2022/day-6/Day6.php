<?php

declare(strict_types=1);

final class Day6
{
    public function __construct()
    {
        var_dump($this->calculate());
    }

    private function calculate(): int
    {
        $handle = fopen("input.txt", "rb");
        $charsRead = 0;
        $sequence = [];

        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $line = trim($line);
                $inputSignalChars = str_split($line);

                while (true) {
                    // Set starting position
                    if ($charsRead === 0) {
                        for ($i = 0; $i < 4; $i++) {
                            $sequence[] = array_shift($inputSignalChars);
                            $charsRead++;
                        }
                    }

                    // Check for unique code
                    if (count($sequence) === count(array_unique($sequence))) {
                        return $charsRead;
                    }

                    // Remove first char from sequence
                    array_shift($sequence);
                    // Move first char from input to last place of sequence
                    array_push($sequence, array_shift($inputSignalChars));
                    $charsRead++;
                }

                fclose($handle);
            }

        }

        return -1;
    }
}

new Day6();
