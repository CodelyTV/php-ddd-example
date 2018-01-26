<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\User\Domain;

use CodelyTv\Types\Aggregate\AggregateRoot;

final class User extends AggregateRoot
{
    private $id;
    private $pendingVideos;

    public function __construct(UserId $id, TotalPendingVideos $pendingVideos)
    {
        $this->id            = $id;
        $this->pendingVideos = $pendingVideos;
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function pendingVideos(): TotalPendingVideos
    {
        return $this->pendingVideos;
    }

    public function increasePending()
    {
        $this->pendingVideos = $this->pendingVideos->increase();
    }
}
