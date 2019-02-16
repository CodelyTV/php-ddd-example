<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Domain;

use DateTime;
use DateTimeImmutable;

final class DateTimeMother
{
    public static function create(string $date, $timezone = null)
    {
        return new DateTimeImmutable($date, $timezone);
    }

    public static function randomStringInterval()
    {
        return sprintf(
            '%d %s',
            NumberMother::between(1, 20),
            RandomElementMother::from(['years', 'minutes', 'hours', 'days'])
        );
    }

    public static function randomPast()
    {
        return static::immutable(MotherCreator::random()->dateTimeBetween('-1 year', 'now'));
    }

    public static function now()
    {
        return self::create('now');
    }

    public static function aLongTimeAgo()
    {
        return static::immutable(MotherCreator::random()->dateTimeBetween('-2 year', '-1 year'));
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
