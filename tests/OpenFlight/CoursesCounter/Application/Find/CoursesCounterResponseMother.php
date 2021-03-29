<?php

declare(strict_types=1);

namespace CodelyTv\Tests\OpenFlight\CoursesCounter\Application\Find;

use CodelyTv\OpenFlight\CoursesCounter\Application\Find\CoursesCounterResponse;
use CodelyTv\OpenFlight\CoursesCounter\Domain\CoursesCounterTotal;
use CodelyTv\Tests\OpenFlight\CoursesCounter\Domain\CoursesCounterTotalMother;

final class CoursesCounterResponseMother
{
    public static function create(?CoursesCounterTotal $total = null): CoursesCounterResponse
    {
        return new CoursesCounterResponse($total?->value() ?? CoursesCounterTotalMother::create()->value());
    }
}
