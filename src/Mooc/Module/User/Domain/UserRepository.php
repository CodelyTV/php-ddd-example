<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Module\User\Domain;

interface UserRepository
{
    public function save(User $user): void;

    public function saveAll(Users $users): void;

    public function search(UserId $id): ?User;

    public function all(): Users;
}
