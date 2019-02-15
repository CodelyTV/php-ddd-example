<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Mooc\Module\User\Application\IncreasePendingVideos;

use CodelyTv\Context\Mooc\Module\User\Application\Find\UserFinder;
use CodelyTv\Context\Mooc\Module\User\Domain\UserId;
use CodelyTv\Context\Mooc\Module\User\Domain\UserRepository;

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
