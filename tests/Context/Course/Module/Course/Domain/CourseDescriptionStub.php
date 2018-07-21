<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\Course\Domain;

use CodelyTv\Context\Course\Module\Course\Domain\CourseDescription;
use CodelyTv\Test\Shared\Domain\WordStub;

final class CourseDescriptionStub
{
    public static function create(string $description)
    {
        return new CourseDescription($description);
    }

    public static function random()
    {
        return self::create(WordStub::random());
    }
}
