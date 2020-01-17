<?php

declare(strict_types = 1);

namespace CodelyTv\Tests\Mooc\CoursesCounter\Application\Find;

use CodelyTv\Mooc\CoursesCounter\Application\Find\CoursesCounterResponse;
use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterTotal;
use CodelyTv\Tests\Mooc\CoursesCounter\Domain\CoursesCounterTotalMother;

final class CoursesCounterResponseMother
{
    public static function create(CoursesCounterTotal $total): CoursesCounterResponse
    {
        return new CoursesCounterResponse($total->value());
    }

    public static function random(): CoursesCounterResponse
    {
        return self::create(CoursesCounterTotalMother::random());
    }
}
