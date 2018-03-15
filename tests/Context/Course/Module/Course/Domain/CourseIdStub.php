<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\Course\Domain;

use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Test\Shared\Domain\UuidStub;

final class CourseIdStub
{
    public static function create(string $id)
    {
        return new CourseId($id);
    }

    public static function random()
    {
        return self::create(UuidStub::random());
    }
}
