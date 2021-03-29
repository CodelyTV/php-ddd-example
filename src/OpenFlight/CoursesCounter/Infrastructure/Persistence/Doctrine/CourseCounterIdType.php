<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\CoursesCounter\Infrastructure\Persistence\Doctrine;

use CodelyTv\OpenFlight\CoursesCounter\Domain\CoursesCounterId;
use CodelyTv\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class CourseCounterIdType extends UuidType
{
    protected function typeClassName(): string
    {
        return CoursesCounterId::class;
    }
}
