<?php

namespace CodelyTv\Context\Course\Module\Course\Application\Find;

use CodelyTv\Shared\Domain\Bus\Query\Query;

final class FindCourseQuery implements Query
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
