<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\User\Domain;

interface UserRepository
{
    public function save(User $user): void;

    public function search(UserId $id): ?User;
}
