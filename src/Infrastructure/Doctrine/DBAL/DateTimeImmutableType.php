<?php

namespace CodelyTv\Infrastructure\Doctrine\DBAL;

use DateTimeImmutable;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\DateTimeType;
use Exception;

final class DateTimeImmutableType extends DateTimeType
{
    const NAME = 'datetime_immutable';

    public function getName()
    {
        return static::NAME;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value instanceof DateTimeImmutable) {
            return $value;
        }

        $dateTime = DateTimeImmutable::createFromFormat($platform->getDateTimeFormatString(), $value);
        if ($dateTime === false) {
            $dateTime = date_create_immutable($value);
        }

        if ($dateTime === false) {
            throw new Exception('Error creating datetimeimmutable');
        }

        return $dateTime;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return false;
    }
}
