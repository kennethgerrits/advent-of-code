<?php

declare(strict_types=1);

namespace helpers;

final class FileReader
{
    public function read(string $filename): iterable
    {
        $handle = \fopen($filename, 'rb');

        if ($handle) {
            while (($line = \fgets($handle)) !== false) {
                $line = trim($line);
                yield $line;
            }
            \fclose($handle);
        }
    }
}
