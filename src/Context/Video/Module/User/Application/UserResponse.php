<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\User\Application;

use CodelyTv\Shared\Domain\Bus\Query\Response;

final class UserResponse implements Response
{
    private $id;
    private $totalPendingVideos;

    public function __construct(string $id, int $totalPendingVideos)
    {
        $this->id                 = $id;
        $this->totalPendingVideos = $totalPendingVideos;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function totalPendingVideos(): int
    {
        return $this->totalPendingVideos;
    }
}
