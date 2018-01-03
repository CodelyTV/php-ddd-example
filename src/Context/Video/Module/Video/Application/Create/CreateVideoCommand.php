<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\Video\Application\Create;

use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Types\ValueObject\Uuid;

final class CreateVideoCommand extends Command
{
    private $id;
    private $type;
    private $title;
    private $url;
    private $courseId;

    public function __construct(Uuid $commandId, string $id, string $type, string $title, string $url, string $courseId)
    {
        parent::__construct($commandId);

        $this->id       = $id;
        $this->type     = $type;
        $this->title    = $title;
        $this->url      = $url;
        $this->courseId = $courseId;
    }

    public function id() : string
    {
        return $this->id;
    }

    public function type() : string
    {
        return $this->type;
    }

    public function title() : string
    {
        return $this->title;
    }

    public function url() : string
    {
        return $this->url;
    }

    public function courseId() : string
    {
        return $this->courseId;
    }
}
