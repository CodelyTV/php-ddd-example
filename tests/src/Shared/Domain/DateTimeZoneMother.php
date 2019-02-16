<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Domain;

use DateTimeZone;

final class DateTimeZoneMother
{
    public static function create(string $timezone)
    {
        return new DateTimeZone($timezone);
    }

    public static function random()
    {
        return self::create(MotherCreator::random()->timezone);
    }

    public static function UTC()
    {
        return self::create('UTC');
    }
}
