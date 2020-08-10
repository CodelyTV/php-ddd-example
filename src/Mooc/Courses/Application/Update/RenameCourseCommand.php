<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\Update;

use CodelyTv\Shared\Domain\Bus\Command\Command;

final class RenameCourseCommand implements Command
{
    private string $id;
    private string $newName;

    public function __construct(string $id, string $newName)
    {
        $this->id = $id;
        $this->newName = $newName;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function newName(): string
    {
        return $this->newName;
    }
}
