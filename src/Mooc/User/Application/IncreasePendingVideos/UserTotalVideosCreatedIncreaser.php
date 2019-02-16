<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\User\Application\IncreasePendingVideos;

use CodelyTv\Mooc\User\Application\Find\UserFinder;
use CodelyTv\Mooc\User\Domain\UserId;
use CodelyTv\Mooc\User\Domain\UserRepository;

final class UserTotalVideosCreatedIncreaser
{
    private $finder;
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->finder = new UserFinder($repository);
        $this->repository = $repository;
    }

    public function __invoke(UserId $id)
    {
        $user = $this->finder->__invoke($id);

        $user->increaseTotalVideosCreated();

        $this->repository->save($user);
    }
}
