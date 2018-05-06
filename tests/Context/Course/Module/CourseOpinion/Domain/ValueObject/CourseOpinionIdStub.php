<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject;

use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionId;
use CodelyTv\Test\Shared\Domain\UuidStub;

final class CourseOpinionIdStub
{
    public static function random(): CourseOpinionId
    {
        return self::create(UuidStub::random());
    }

    public static function create(string $id): CourseOpinionId
    {
        return new CourseOpinionId($id);
    }
}
