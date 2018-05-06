<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\CourseOpinion\Domain\Repository;

use CodelyTv\Context\Course\Module\Course\Domain\Entity\Course;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\Entity\CourseOpinion;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionId;

interface CourseOpinionRepository
{
    public function save(CourseOpinion $opinion): void;

    public function findById(CourseOpinionId $id): ?CourseOpinion;

    public function getRating(Course $course): \CodelyTv\Context\Course\Module\Course\Domain\ValueObject\CourseRating;
}
