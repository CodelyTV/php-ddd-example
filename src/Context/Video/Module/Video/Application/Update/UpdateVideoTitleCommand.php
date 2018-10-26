<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\Video\Application\Create;

use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

final class UpdateVideoTitleCommand extends Command
{
    private $id;
    private $title;
    private $courseId;

    public function __construct(Uuid $commandId, string $id, string $title, string $courseId)
    {
        parent::__construct($commandId);

        $this->id       = $id;
        $this->title    = $title;
        $this->courseId = $courseId;
    }

    public function id() : string
    {
        return $this->id;
    }

    public function title() : string
    {
        return $this->title;
    }

    public function courseId() : string
    {
        return $this->courseId;
    }
}
