<?php
declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Courses\Domain;

use CodelyTv\Mooc\Courses\Domain\CourseCreatedAt;

final class CourseCreatedAtMother
{
    public static function create(?string $value = null): CourseCreatedAt
    {
        return new CourseCreatedAt(new \DateTimeImmutable('now'));
    }

}
