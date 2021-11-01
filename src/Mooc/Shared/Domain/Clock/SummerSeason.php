<?php

namespace CodelyTv\Mooc\Shared\Domain\Clock;

use CodelyTv\Mooc\Shared\Infrastructure\Clock\CustomClock;

class SummerSeason extends Season
{
    public function start(): ClockInterface
    {
        return new CustomClock(DateTime::setDate(self::getYear(), 6, 21));
    }

    public function ends(): ClockInterface
    {
        return new CustomClock(DateTime::setDate(self::getYear(), 9, 22));
    }
}