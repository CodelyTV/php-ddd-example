<?php

namespace CodelyTv\Test\Stub;

use DateTimeZone;

final class DateTimeZoneStub
{
    public static function create(string $timezone)
    {
        return new DateTimeZone($timezone);
    }

    public static function random()
    {
        return self::create(StubCreator::random()->timezone);
    }

    public static function UTC()
    {
        return self::create('UTC');
    }
}
