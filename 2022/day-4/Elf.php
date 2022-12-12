<?php

declare(strict_types=1);

final class Elf
{
    public function __construct(
        public readonly int $from,
        public readonly int $till,
        public readonly int $netSpace,
    ) {
    }
}
