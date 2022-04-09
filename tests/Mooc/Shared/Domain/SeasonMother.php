<?php

namespace CodelyTv\Tests\Mooc\Shared\Domain;

use CodelyTv\Mooc\Shared\Application\DetectSeason\DetectSeasonUseCase;
use CodelyTv\Mooc\Shared\Infrastructure\Clock\CustomClock;
use CodelyTv\Mooc\Shared\Domain\Clock\ClockInterface;
use DateTime;

class SeasonMother
{
    public static function randomSummer(): ClockInterface
    {
        return new CustomClock((new DateTime())->setDate(2021, 8, 21));
    }

    public static function randomFall(): ClockInterface
    {
        return new CustomClock((new DateTime())->setDate(2021, 11, 21));
    }

    public static function randomSpring(): ClockInterface
    {
        return new CustomClock((new DateTime())->setDate(2021, 4, 20));
    }

    public static function randomWinter(): ClockInterface
    {
        return new CustomClock((new DateTime())->setDate(2021, 12, 28));
    }

    public static function leapYearDate(): ClockInterface
    {
        return new CustomClock((new DateTime())->setDate(2024, 2, 29));
    }
}