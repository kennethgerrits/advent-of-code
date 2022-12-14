<?php

declare(strict_types=1);

namespace day2;

require_once "OpponentWeapon.php";
require_once "SelfWeapon.php";
require_once "Strategy.php";

final class Day2
{
    private const ROCK_PICK_BONUS = 1;
    private const PAPER_PICK_BONUS = 2;
    private const SCISSORS_PICK_BONUS = 3;

    private const MATCH_LOST = 0;
    private const MATCH_DRAW = 3;
    private const MATCH_WON = 6;

    public function __construct()
    {
        var_dump($this->calculate());
    }

    private function calculate(): int
    {
        $handle = fopen("input.txt", "r");
        $score = 0;

        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $line = trim($line);
                $opponentWeapon = OpponentWeapon::tryFrom($line[0]);
                $strategy = Strategy::tryFrom($line[2]);
                $score += $this->battle($opponentWeapon, $strategy);
            }

            fclose($handle);
        }

        return $score;
    }

    private function battle(OpponentWeapon $opponentWeapon, Strategy $strategy): int
    {
        $selfWeapon = match ($strategy) {
            Strategy::WIN => $this->weaponForWin($opponentWeapon),
            Strategy::DRAW => $this->weaponForDraw($opponentWeapon),
            Strategy::LOSE => $this->weaponForLoss($opponentWeapon),
        };

        $result = match ($opponentWeapon) {
            OpponentWeapon::ROCK => $this->rockAttack($selfWeapon),
            OpponentWeapon::PAPER => $this->paperAttack($selfWeapon),
            OpponentWeapon::SCISSORS => $this->scissorsAttack($selfWeapon),
        };
        $result += $this->getWeaponBonus($selfWeapon);

        return $result;
    }

    private function weaponForWin(OpponentWeapon $opponentWeapon): SelfWeapon
    {
        return match ($opponentWeapon) {
            OpponentWeapon::ROCK => SelfWeapon::PAPER,
            OpponentWeapon::PAPER => SelfWeapon::SCISSORS,
            OpponentWeapon::SCISSORS => SelfWeapon::ROCK,
        };
    }

    private function weaponForDraw(OpponentWeapon $opponentWeapon): SelfWeapon
    {
        return match ($opponentWeapon) {
            OpponentWeapon::ROCK => SelfWeapon::ROCK,
            OpponentWeapon::PAPER => SelfWeapon::PAPER,
            OpponentWeapon::SCISSORS => SelfWeapon::SCISSORS,
        };
    }

    private function weaponForLoss(OpponentWeapon $opponentWeapon): SelfWeapon
    {
        return match ($opponentWeapon) {
            OpponentWeapon::ROCK => SelfWeapon::SCISSORS,
            OpponentWeapon::PAPER => SelfWeapon::ROCK,
            OpponentWeapon::SCISSORS => SelfWeapon::PAPER,
        };
    }

    private function rockAttack(SelfWeapon $selfWeapon): int
    {
        return match ($selfWeapon) {
            SelfWeapon::ROCK => self::MATCH_DRAW,
            SelfWeapon::PAPER => self::MATCH_WON,
            SelfWeapon::SCISSORS => self::MATCH_LOST,
        };
    }

    private function paperAttack(SelfWeapon $selfWeapon): int
    {
        return match ($selfWeapon) {
            SelfWeapon::ROCK => self::MATCH_LOST,
            SelfWeapon::PAPER => self::MATCH_DRAW,
            SelfWeapon::SCISSORS => self::MATCH_WON,
        };
    }

    private function scissorsAttack(SelfWeapon $selfWeapon): int
    {
        return match ($selfWeapon) {
            SelfWeapon::ROCK => self::MATCH_WON,
            SelfWeapon::PAPER => self::MATCH_LOST,
            SelfWeapon::SCISSORS => self::MATCH_DRAW,
        };
    }

    private function getWeaponBonus(SelfWeapon $weapon): int
    {
        return match ($weapon) {
            SelfWeapon::ROCK => self::ROCK_PICK_BONUS,
            SelfWeapon::PAPER => self::PAPER_PICK_BONUS,
            SelfWeapon::SCISSORS => self::SCISSORS_PICK_BONUS,
        };
    }
}

new Day2();
