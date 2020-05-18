<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Courses\Application\Update;

use CodelyTv\Shared\Domain\Bus\Command\Command;

final class CourseRenamerCommand implements Command
{
    private $id;
    private $name;

    public function __construct(string $id, string $newName)
    {
        $this->id       = $id;
        $this->name     = $newName;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
}
