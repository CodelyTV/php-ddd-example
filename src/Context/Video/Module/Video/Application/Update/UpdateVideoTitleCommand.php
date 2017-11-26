<?php

namespace CodelyTv\Context\Video\Module\Video\Application\Update;

use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Types\ValueObject\Uuid;

final class UpdateVideoTitleCommand extends Command
{
    private $id;
    private $newTitle;

    public function __construct(Uuid $commandId, string $id, string $newTitle)
    {
        parent::__construct($commandId);

        $this->id       = $id;
        $this->newTitle    = $newTitle;
    }

    public function id() : string
    {
        return $this->id;
    }

    public function newTitle() : string
    {
        return $this->newTitle;
    }

}
