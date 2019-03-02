<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Domain;

use DateTime;
use DateTimeImmutable;

final class DateTimeMother
{
    public static function create(string $date, $timezone = null): DateTimeImmutable
    {
        return new DateTimeImmutable($date, $timezone);
    }

    public static function randomStringInterval(): string
    {
        return sprintf(
            '%d %s',
            NumberMother::between(1, 20),
            RandomElementMother::from(['years', 'minutes', 'hours', 'days'])
        );
    }

    public static function randomPast(): DateTimeImmutable
    {
        return static::immutable(MotherCreator::random()->dateTimeBetween('-1 year'));
    }

    public static function now(): DateTimeImmutable
    {
        return self::create('now');
    }

    public static function aLongTimeAgo(): DateTimeImmutable
    {
        return static::immutable(MotherCreator::random()->dateTimeBetween('-2 year', '-1 year'));
    }

    public static function random(): DateTimeImmutable
    {
        return new DateTimeImmutable();
    }

    private static function immutable(DateTime $date): DateTimeImmutable
    {
        return DateTimeImmutable::createFromMutable($date);
    }
}
