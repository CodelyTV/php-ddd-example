<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Student\Domain;

use CodelyTv\Mooc\Student\Domain\StudentTotalVideosCreated;
use CodelyTv\Test\Shared\Domain\NumberMother;

final class StudentTotalVideosCreatedMother
{
    public static function create(int $total)
    {
        return new StudentTotalVideosCreated($total);
    }

    public static function random()
    {
        return self::create(NumberMother::lessThan(100));
    }
}
