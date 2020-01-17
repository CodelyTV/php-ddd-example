<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Courses\Infrastructure\Persistence\Doctrine;

use CodelyTv\Mooc\Shared\Domain\Course\CourseId;
use CodelyTv\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class CourseIdType extends UuidType
{
    public static function customTypeName(): string
    {
        return 'course_id';
    }

    protected function typeClassName(): string
    {
        return CourseId::class;
    }
}
