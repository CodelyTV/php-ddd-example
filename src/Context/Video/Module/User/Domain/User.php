<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\User\Domain;

use CodelyTv\Types\Aggregate\AggregateRoot;

final class User extends AggregateRoot
{
    private $id;
    private $totalVideosCreated;

    public function __construct(UserId $id, TotalVideosCreated $totalVideosCreated)
    {
        $this->id                 = $id;
        $this->totalVideosCreated = $totalVideosCreated;
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function totalVideosCreated(): TotalVideosCreated
    {
        return $this->totalVideosCreated;
    }

    public function increaseTotalVideosCreated()
    {
        $this->totalVideosCreated = $this->totalVideosCreated->increase();
    }
}
