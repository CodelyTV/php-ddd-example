<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Domain;

use CodelyTv\Shared\Domain\DomainError;

final class CoursesNotFound extends DomainError
{

    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'courses_not_found';
    }

    protected function errorMessage(): string
    {
        return sprintf('Courses not found');
    }
}
