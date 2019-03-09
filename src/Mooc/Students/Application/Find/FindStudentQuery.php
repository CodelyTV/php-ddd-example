<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Students\Application\Find;

use CodelyTv\Shared\Domain\Bus\Query\Query;

final class FindStudentQuery implements Query
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
