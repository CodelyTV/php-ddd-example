<?php
declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Domain;

use CodelyTv\Shared\Domain\DomainError;

final class NotExistCourseException extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'courses_ table_is_empty';
    }

    protected function errorMessage(): string
    {
        return sprintf('There no courses on the databases');
    }
}
