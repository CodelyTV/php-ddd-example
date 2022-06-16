<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Create;

use CodelyTv\Shared\Domain\Bus\Command\Command;

final class CreateVideoCommand implements Command
{
    public function __construct(
        private readonly string $id,
        private readonly string $type,
        private readonly string $title,
        private readonly string $url,
        private readonly string $courseId
    ) {
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
}
