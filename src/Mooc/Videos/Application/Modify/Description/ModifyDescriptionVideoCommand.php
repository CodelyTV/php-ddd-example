<?php

declare (strict_types = 1);

namespace CodelyTv\Mooc\Videos\Application\Modify\Description;

use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

final class ModifyDescriptionVideoCommand extends Command
{
    private $videoId;
    private $newDescription;

    public function __construct(Uuid $commandId, string $videoId, string $newDescription)
    {
        parent::__construct($commandId);

        $this->videoId        = $videoId;
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
