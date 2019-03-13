<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Update;

use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

final class UpdateVideoTitleCommand extends Command
{
    private $id;

    private $title;

    public function __construct(Uuid $messageId, string $id, string $title)
    {
        parent::__construct($messageId);

        $this->id = $id;
        $this->title = $title;
    }

    public function id()
    {
        return $this->id;
    }

    public function title()
    {
        return $this->title;
    }
}