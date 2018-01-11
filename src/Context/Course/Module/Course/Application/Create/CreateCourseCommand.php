<?php

namespace CodelyTv\Context\Course\Module\Course\Application\Create;

use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Types\ValueObject\Uuid;

final class CreateCourseCommand extends Command
{
    private $id;
    private $title;
    private $description;

    public function __construct(Uuid $messageId, string $id, string $title, string $description)
    {
        parent::__construct($messageId);

        $this->id          = $id;
        $this->title       = $title;
        $this->description = $description;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function description(): string
    {
        return $this->description;
    }
}
