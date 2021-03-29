<?php

declare(strict_types=1);

namespace CodelyTv\Tests\OpenFlight\Courses\Domain;

use CodelyTv\OpenFlight\Courses\Domain\CourseName;
use CodelyTv\Tests\Shared\Domain\WordMother;

final class CourseNameMother
{
    public static function create(?string $value = null): CourseName
    {
        return new CourseName($value ?? WordMother::create());
    }
}
