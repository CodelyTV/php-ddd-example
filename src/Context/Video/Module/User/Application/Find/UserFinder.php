<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\User\Application\Find;

use CodelyTv\Context\Video\Module\User\Domain\UserId;
use CodelyTv\Context\Video\Module\User\Domain\UserNotExist;
use CodelyTv\Context\Video\Module\User\Domain\UserRepository;

final class UserFinder
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UserId $id)
    {
        $user = $this->repository->search($id);

        if (null === $user) {
            throw new UserNotExist($id);
        }

        return $user;
    }
}
