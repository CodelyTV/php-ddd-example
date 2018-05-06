<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject;

use CodelyTv\Context\Course\Module\Course\Domain\ValueObject\CourseDescription;
use CodelyTv\Test\Shared\Domain\StubCreator;

final class CourseDescriptionStub
{
    public static function random(): CourseDescription
    {
        return self::create(
            StubCreator::random()->text()
        );
    }

    public static function create(string $text): CourseDescription
    {
        return new CourseDescription($text);
    }
}
