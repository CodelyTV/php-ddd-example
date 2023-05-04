<?php

namespace CodelyTv\Mooc\Videos\Application\Update;

use CodelyTv\Shared\Domain\Bus\Command\Command;

class UploadVideoDescription implements Command
{
    private string $id;

    private string $newTitle;

    public function __construct(string $id, string $newTitle)
    {
        $this->id = $id;
        $this->newTitle = $newTitle;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getNewTitle(): string
    {
        return $this->newTitle;
    }
}