<?php

declare(strict_types=1);

namespace CodelyTv\Backoffice\Courses\Application;

final class BackofficeCourseResponse
{
    public function __construct(private readonly string $id, private readonly string $name, private readonly string $duration)
    {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function duration(): string
    {
        return $this->duration;
    }
}
