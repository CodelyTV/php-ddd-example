<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\User\Infrastructure\Persistence;

use CodelyTv\Context\Video\Module\User\Domain\User;
use CodelyTv\Context\Video\Module\User\Domain\UserId;
use CodelyTv\Context\Video\Module\User\Domain\UserRepository;
use CodelyTv\Context\Video\Module\User\Domain\Users;
use CodelyTv\Infrastructure\Doctrine\Repository;
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
