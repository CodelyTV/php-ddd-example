<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Courses\Domain;

interface CourseGenerationNotificator
{
    public function notifyCourseCreated(Course $course): void;
}