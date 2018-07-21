<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\Course\Domain;

use CodelyTv\Context\Course\Module\Course\Domain\Course;
use CodelyTv\Context\Course\Module\Course\Domain\CourseDescription;
use CodelyTv\Context\Course\Module\Course\Domain\CourseTitle;
use CodelyTv\Context\Video\Module\Video\Domain\Video;
use CodelyTv\Shared\Domain\CourseId;

final class CourseStub
{
    public static function withId(CourseId $id)
    {
        return self::create(
            $id,
            CourseTitleStub::random(),
            CourseDescriptionStub::random()
        );
    }

    public static function create(CourseId $id, CourseTitle $title, CourseDescription $description)
    {
        return new Course($id, $title, $description);
    }

    public static function random(): Video
    {
        return self::create(
            CourseIdStub::random(),
            CourseTitleStub::random(),
            CourseDescriptionStub::random()
        );
    }
}
