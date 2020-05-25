<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Domain;

use CodelyTv\Shared\Domain\DomainError;

final class CourseEmpty extends DomainError
{
    public function errorCode(): string
    {
        return 'courses_empty';
    }

    protected function errorMessage(): string
    {
        return sprintf('There are not courses created.');
    }
}
