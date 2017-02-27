<?php

namespace CodelyTv\Context\Video\Module\Video\Domain\Create;

use CodelyTv\Shared\Domain\Bus\Command\Command;

final class CreateVideoCommand implements Command
{
    private $id;
    private $title;
    private $url;
    private $courseId;

    public function __construct(string $id, string $title, string $url, string $courseId)
    {
        $this->id       = $id;
        $this->title    = $title;
        $this->url      = $url;
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

    public function url() : string
    {
        return $this->url;
    }

    public function courseId() : string
    {
        return $this->courseId;
    }
}
