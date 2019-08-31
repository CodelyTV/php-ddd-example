<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Videos\Application\Create;

use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

final class CreateVideoCommand extends Command
{
    private $id;
    private $type;
    private $title;
    private $url;
    private $courseId;
    private $published;

    public function __construct(Uuid $commandId, string $id, string $type, string $title, string $url,
                                string $courseId, string $published
    )
    {
        parent::__construct($commandId);

        $this->id       = $id;
        $this->type     = $type;
        $this->title    = $title;
        $this->url      = $url;
        $this->courseId = $courseId;
        $this->published = $published;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function url(): string
    {
        return $this->url;
    }

    public function courseId(): string
    {
        return $this->courseId;
    }

    public function published(): string
    {
        return $this->published;
    }
}
