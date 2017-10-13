<?php

namespace CodelyTv\Context\Course\Module\Course\Domain;

interface CourseRepository
{
    public function save(Course $course);
}
