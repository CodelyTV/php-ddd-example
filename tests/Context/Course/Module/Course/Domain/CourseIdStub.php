<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\Course\Domain;

use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Test\Shared\Domain\UuidStub;

final class CourseIdStub
{
    public static function random(): CourseId
    {
        return self::create(UuidStub::random());
    }

    public static function create(string $id): CourseId
    {
        return new CourseId($id);
    }
}
