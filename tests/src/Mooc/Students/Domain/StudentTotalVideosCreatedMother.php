<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Students\Domain;

use CodelyTv\Mooc\Students\Domain\StudentTotalVideosCreated;
use CodelyTv\Test\Shared\Domain\NumberMother;

final class StudentTotalVideosCreatedMother
{
    public static function create(int $total): StudentTotalVideosCreated
    {
        return new StudentTotalVideosCreated($total);
    }

    public static function random(): StudentTotalVideosCreated
    {
        return self::create(NumberMother::lessThan(100));
    }
}
