<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\Find;

final class CoursesResponseConverter
{
    /**
     * @param array
     * @return CoursesResponse
     */
    public function __invoke(array $courses): CoursesResponse
    {
        return new CoursesResponse($courses);
    }
}