<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject;

use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionPublished;
use CodelyTv\Test\Shared\Domain\BoolStub;

final class CourseOpinionPublishedStub
{
    public static function random(): CourseOpinionPublished
    {
        return self::create(
            BoolStub::random()
        );
    }

    public static function create(bool $published): CourseOpinionPublished
    {
        return new CourseOpinionPublished($published);
    }
}
