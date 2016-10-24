<?php

namespace CodelyTv\Shared\Test\Stub;

use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Test\Stub\UuidStub;

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
