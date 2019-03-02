<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Domain;

use DateTimeZone;

final class DateTimeZoneMother
{
    public static function create(string $timezone): DateTimeZone
    {
        return new DateTimeZone($timezone);
    }

    public static function random(): DateTimeZone
    {
        return self::create(MotherCreator::random()->timezone);
    }

    public static function UTC(): DateTimeZone
    {
        return self::create('UTC');
    }
}
