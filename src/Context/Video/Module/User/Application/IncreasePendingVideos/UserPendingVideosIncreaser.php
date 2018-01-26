<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\User\Application\IncreasePendingVideos;

use CodelyTv\Context\Video\Module\User\Domain\UserRepository;

final class UserPendingVideosIncreaser
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $users = $this->repository->all();
        $users->increasePending();

        $this->repository->saveAll($users);
    }
}
