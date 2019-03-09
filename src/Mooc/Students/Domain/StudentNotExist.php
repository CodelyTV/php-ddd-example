<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Students\Domain;

use CodelyTv\Shared\Domain\DomainError;

final class StudentNotExist extends DomainError
{
    private $id;

    public function __construct(StudentId $id)
    {
        $this->id = $id;

        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'student_not_exist';
    }

    protected function errorMessage(): string
    {
        return sprintf('The student <%s> does not exists', $this->id->value());
    }
}
