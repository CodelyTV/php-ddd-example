<?php

namespace CodelyTv\Mooc\Videos\Application\Update;

use CodelyTv\Shared\Domain\Bus\Command\Command;

final class EditDescriptionVideoCommand implements Command
{
    private $videoId;
    private $newDescription;

    public function __construct(string $videoId, string $newDescription)
    {
        $this->videoId  = $videoId;
        $this->newDescription = $newDescription;
    }

    public function videoId(): string
    {
        return $this->videoId;
    }

    public function newDescription(): string
    {
        return $this->newDescription;
    }
}