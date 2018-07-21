<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\Course\Domain;

use CodelyTv\Context\Course\Module\Course\Domain\CourseTitle;
use CodelyTv\Test\Shared\Domain\WordStub;

final class CourseTitleStub
{
    public static function create(string $title)
    {
        return new CourseTitle($title);
    }

    public static function random()
    {
        return self::create(WordStub::random());
    }
}
