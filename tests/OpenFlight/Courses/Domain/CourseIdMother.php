<?php

declare(strict_types=1);

namespace CodelyTv\Tests\OpenFlight\Courses\Domain;

use CodelyTv\OpenFlight\Shared\Domain\Courses\CourseId;
use CodelyTv\Tests\Shared\Domain\UuidMother;

final class CourseIdMother
{
    public static function create(?string $value = null): CourseId
    {
        return new CourseId($value ?? UuidMother::create());
    }
}
