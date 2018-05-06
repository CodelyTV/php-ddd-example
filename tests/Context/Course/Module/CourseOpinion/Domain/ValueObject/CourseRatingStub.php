<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject;

use CodelyTv\Context\Course\Module\Course\Domain\ValueObject\CourseRating;
use CodelyTv\Test\Shared\Domain\StubCreator;

final class CourseRatingStub
{
    public static function random(): CourseRating
    {
        return self::create(
            StubCreator::random()->numberBetween(0, 5)
        );
    }

    public static function create(int $value): CourseRating
    {
        return new CourseRating($value);
    }
}
