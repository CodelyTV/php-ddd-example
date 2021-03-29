<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Courses\Infrastructure\Persistence\Doctrine;

use CodelyTv\OpenFlight\Shared\Domain\Courses\CourseId;
use CodelyTv\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class CourseIdType extends UuidType
{
    protected function typeClassName(): string
    {
        return CourseId::class;
    }
}
