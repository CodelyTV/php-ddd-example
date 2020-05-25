<?php
declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\Update;

use CodelyTv\Shared\Domain\Bus\Command\Command;

final class CourseRenamerCommand implements Command
{
    private string $id;
    private string $newName;

    public function __construct(string $id, string $newName)
    {
        $this->id      = $id;
        $this->newName = $newName;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getNewName(): string
    {
        return $this->newName;
    }
}