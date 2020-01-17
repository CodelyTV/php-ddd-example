<?php

declare(strict_types = 1);

namespace CodelyTv\Backoffice\Auth\Domain;

final class AuthUser
{
    private $username;
    private $password;

    public function __construct(AuthUsername $username, AuthPassword $password)
    {
        $this->username = $username;
        $this->password = $password;
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
