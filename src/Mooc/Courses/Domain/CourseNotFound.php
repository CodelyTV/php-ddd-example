<?php

namespace CodelyTv\Mooc\Courses\Domain;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Shared\Domain\DomainError;

class CourseNotFound extends DomainError
{
    private $id;

    public function __construct(CourseId $id)
    {
        $this->id = $id;

        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'course_not_found';
    }

    protected function errorMessage(): string
    {
        return sprintf('The course <%s> has not been found', $this->id->value());
    }
}