<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Domain;

use CodelyTv\Mooc\Shared\Domain\Course\CourseId;
use CodelyTv\Shared\Domain\DomainError;

final class CourseDuplicated extends DomainError
{
    private CourseId $id;

    public function __construct(CourseId $id)
    {
        $this->id = $id;

        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'course_duplicated';
    }

    protected function errorMessage(): string
    {
        return sprintf('The course <%s> is duplicated', $this->id->value());
    }
}
