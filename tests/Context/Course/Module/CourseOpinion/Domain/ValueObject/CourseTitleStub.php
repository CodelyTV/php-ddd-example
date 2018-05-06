<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject;

use CodelyTv\Context\Course\Module\Course\Domain\ValueObject\CourseTitle;
use CodelyTv\Test\Shared\Domain\StubCreator;

final class CourseTitleStub
{
    public static function random(): CourseTitle
    {
        return self::create(
            StubCreator::random()->words(5, true)
        );
    }

    public static function create(string $text): CourseTitle
    {
        return new CourseTitle($text);
    }
}
