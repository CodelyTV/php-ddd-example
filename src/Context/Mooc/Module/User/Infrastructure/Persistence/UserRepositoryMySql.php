<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Mooc\Module\User\Infrastructure\Persistence;

use CodelyTv\Context\Mooc\Module\User\Domain\User;
use CodelyTv\Context\Mooc\Module\User\Domain\UserId;
use CodelyTv\Context\Mooc\Module\User\Domain\UserRepository;
use CodelyTv\Context\Mooc\Module\User\Domain\Users;
use CodelyTv\Shared\Infrastructure\Doctrine\Repository;
use function Lambdish\Phunctional\each;

final class UserRepositoryMySql extends Repository implements UserRepository
{
    public function save(User $user): void
    {
        $this->persist($user);
    }

    public function saveAll(Users $users): void
    {
        each($this->persister(), $users);
    }

    public function search(UserId $id): ?User
    {
        return $this->repository(User::class)->find($id);
    }

    public function all(): Users
    {
        return new Users($this->repository(User::class)->findAll());
    }
}
