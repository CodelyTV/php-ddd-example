<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\User\Infrastructure\Persistence;

use CodelyTv\Context\Video\Module\User\Domain\User;
use CodelyTv\Context\Video\Module\User\Domain\UserId;
use CodelyTv\Context\Video\Module\User\Domain\UserRepository;
use CodelyTv\Infrastructure\Doctrine\Repository;

final class UserRepositoryMySql extends Repository implements UserRepository
{
    public function save(User $user): void
    {
        $this->persist($user);
    }

    public function search(UserId $id): ?User
    {
        return $this->repository(User::class)->find($id);
    }
}
