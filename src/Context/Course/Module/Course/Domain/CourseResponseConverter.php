<?php

namespace CodelyTv\Context\Course\Module\Course\Domain;

final class CourseResponseConverter
{
    public function __invoke(Course $course)
    {
        return new CourseResponse($course->id(), $course->title(), $course->description());
    }
}
