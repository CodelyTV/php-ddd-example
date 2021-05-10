<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Courses\Domain;

use CodelyTv\Mooc\Courses\Application\Find\CoursesResponse;

final class CoursesResponseMother
{
    public static function create(array $courses): CoursesResponse
    {
        return new CoursesResponse($courses);
    }

}
