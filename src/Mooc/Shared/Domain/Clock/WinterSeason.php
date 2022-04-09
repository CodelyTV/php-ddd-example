<?php

namespace CodelyTv\Mooc\Shared\Domain\Clock;

use CodelyTv\Mooc\Shared\Infrastructure\Clock\CustomClock;
use DateTime;

class WinterSeason extends Season
{
    public function start(): ClockInterface
    {
        return new CustomClock((new DateTime())->setDate(self::getYear(), 12, 21));
    }

    public function ends(): ClockInterface
    {
        return new CustomClock((new DateTime())->setDate(self::getYear() + 1, 3, 20));
    }
}