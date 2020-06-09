<?php
declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\CoursesCounter\Application\Find;

use CodelyTv\Mooc\CoursesCounter\Application\Find\CourseResponse;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseMother;

final class FindAllCoursesResponseMother
{
    public static function create(array $courses): CourseResponse
    {
        return new CourseResponse($courses);
    }

    public static function random(): CourseResponse
    {
        return self::create([
            CourseMother::random(),
            CourseMother::random()
        ]);
    }
}