<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Domain;

use DateTimeImmutable;
use function CodelyTv\Utils\Shared\date_to_string;

final class DateTimestampMother
{
    public static function create(string $date): string
    {
        return date_to_string(new DateTimeImmutable($date));
    }

    public static function random(): string
    {
        return date_to_string(new DateTimeImmutable());
    }
}
