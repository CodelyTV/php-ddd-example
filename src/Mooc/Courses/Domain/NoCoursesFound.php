<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Domain;

use CodelyTv\Shared\Domain\DomainError;

final class NoCoursesFound extends DomainError
{
    public function errorCode(): string
    {
        return 'no_courses_found';
    }

    protected function errorMessage(): string
    {
        return sprintf('There are zero courses on our system');
    }
}
