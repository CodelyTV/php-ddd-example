<?php

namespace CodelyTv\Mooc\Shared\Domain\Clock;

use CodelyTv\Mooc\Shared\Infrastructure\Clock\CustomClock;
use \CodelyTv\Mooc\Shared\Domain\Clock\ClockInterface;
use DateTime;

class FallSeason extends Season
{
    public function start(): ClockInterface
    {
        return new CustomClock(DateTime::setDate(self::getYear(), 9, 22));
    }

    public function ends(): ClockInterface
    {
        return new CustomClock(DateTime::setDate(self::getYear(), 12, 21));
    }
}