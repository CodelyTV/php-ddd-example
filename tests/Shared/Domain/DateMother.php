<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Shared\Domain;

final class DateMother
{
    public static function create(string $date = null): string
    {
        return $date ?? MotherCreator::random()->dateTimeThisCentury()->format('Y-m-d H:i:s');
    }
}
