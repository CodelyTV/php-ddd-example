<?php

namespace CodelyTv\Test\Shared\Domain;

use DateTime;
use DateTimeImmutable;

final class DateTimeStub
{
    public static function create(string $date, $timezone = null)
    {
        return new DateTimeImmutable($date, $timezone);
    }

    public static function randomStringInterval()
    {
        return sprintf(
            '%d %s',
            NumberStub::between(1, 20),
            RandomElementStub::from(['years', 'minutes', 'hours', 'days'])
        );
    }

    public static function randomPast()
    {
        return static::immutable(StubCreator::random()->dateTimeBetween('-1 year', 'now'));
    }

    public static function now()
    {
        return self::create('now');
    }

    public static function aLongTimeAgo()
    {
        return static::immutable(StubCreator::random()->dateTimeBetween('-2 year', '-1 year'));
    }

    public static function random()
    {
        return new DateTimeImmutable();
    }

    private static function immutable(DateTime $date)
    {
        return DateTimeImmutable::createFromMutable($date);
    }
}
