<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Students\Application\Find;

use CodelyTv\Shared\Domain\Bus\Query\Response;

final class StudentResponse implements Response
{
    private $id;
    private $name;
    private $totalPendingVideos;

    public function __construct(string $id, string $name, int $totalPendingVideos)
    {
        $this->id                 = $id;
        $this->name               = $name;
        $this->totalPendingVideos = $totalPendingVideos;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function totalPendingVideos(): int
    {
        return $this->totalPendingVideos;
    }
}
