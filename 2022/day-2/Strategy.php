<?php

declare(strict_types=1);

namespace day2;

enum Strategy: string
{
    case LOSE = 'X';
    case DRAW = 'Y';
    case WIN = 'Z';
}
