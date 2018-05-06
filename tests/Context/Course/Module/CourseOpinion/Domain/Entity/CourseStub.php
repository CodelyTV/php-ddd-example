<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\Entity;

use CodelyTv\Context\Course\Module\Course\Domain\Entity\Course;
use CodelyTv\Context\Course\Module\Course\Domain\ValueObject\CourseDescription;
use CodelyTv\Context\Course\Module\Course\Domain\ValueObject\CourseTitle;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Test\Context\Course\Module\Course\Domain\CourseIdStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseDescriptionStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseTitleStub;

final class CourseStub
{
    public static function random(): Course
    {
        $id          = CourseIdStub::random();
        $title       = CourseTitleStub::random();
        $description = CourseDescriptionStub::random();

        return self::create($id, $title, $description);
    }

    public static function create(CourseId $id, CourseTitle $title, CourseDescription $description): Course
    {
        return Course::create($id, $title, $description);
    }
}
