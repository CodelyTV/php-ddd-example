<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\User\Infrastructure\Persistence;

use CodelyTv\Mooc\User\Domain\User;
use CodelyTv\Mooc\User\Domain\UserId;
use CodelyTv\Mooc\User\Domain\UserRepository;
use CodelyTv\Mooc\User\Domain\Users;
use CodelyTv\Shared\Infrastructure\Doctrine\DoctrineRepository;
use function Lambdish\Phunctional\each;

final class UserRepositoryMySql extends DoctrineRepository implements UserRepository
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
