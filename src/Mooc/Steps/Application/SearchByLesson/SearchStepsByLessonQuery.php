<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Steps\Application\SearchByLesson;

use CodelyTv\Shared\Domain\Bus\Query\Query;

final class SearchStepsByLessonQuery implements Query
{
    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}
