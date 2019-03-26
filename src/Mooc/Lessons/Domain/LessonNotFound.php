<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Lessons\Domain;

use CodelyTv\Mooc\Shared\Domain\Lessons\LessonId;
use CodelyTv\Shared\Domain\DomainError;

final class LessonNotFound extends DomainError
{
    private $id;

    public function __construct(LessonId $id)
    {
        $this->id = $id;

        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'lesson_not_found';
    }

    protected function errorMessage(): string
    {
        return sprintf('The lesson <%s> has not been found', $this->id->value());
    }
}
