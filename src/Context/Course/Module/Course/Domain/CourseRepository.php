<?php

namespace CodelyTv\Context\Course\Module\Course\Domain;

use CodelyTv\Shared\Domain\CourseId;

/**
 * CourseRepository
 */
interface CourseRepository
{
    /**
     * @param Course $course
     *
     * @return mixed
     */
    public function save(Course $course);

    /**
     * @param CourseId $id
     *
     * @return Course|null
     */
    public function search(CourseId $id): ?Course;
}