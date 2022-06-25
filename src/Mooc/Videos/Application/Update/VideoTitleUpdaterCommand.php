<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Update;

final class VideoTitleUpdaterCommand
{
    public function __construct(
        private readonly string $id,
        private readonly string $title,
        private readonly string $courseId,
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function courseId(): string
    {
        return $this->courseId;
    }


}