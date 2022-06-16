<?php

declare(strict_types=1);

namespace CodelyTv\Backoffice\Auth\Domain;

final class AuthUser
{
    public function __construct(private readonly AuthUsername $username, private readonly AuthPassword $password)
    {
    }

    public function passwordMatches(AuthPassword $password): bool
    {
        return $this->password->isEquals($password);
    }

    public function username(): AuthUsername
    {
        return $this->username;
    }
}
