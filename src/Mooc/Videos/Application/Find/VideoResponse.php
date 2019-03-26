<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Videos\Application\Find;

use CodelyTv\Shared\Domain\Bus\Query\Response;

final class VideoResponse implements Response
{
    private $id;
    private $type;
    private $title;
    private $url;
    private $courseId;
    private $dateTimeAdded;

    public function __construct(string $id, string $type, string $title, string $url, string $courseId, int $dateTimeAdded)
    {
        $this->id       = $id;
        $this->type     = $type;
        $this->title    = $title;
        $this->url      = $url;
        $this->courseId = $courseId;
        $this->dateTimeAdded = $dateTimeAdded;
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

    public function dateTimeAdded(): int
    {
        return $this->dateTimeAdded;
    }
}
