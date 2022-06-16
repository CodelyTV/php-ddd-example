<?php

declare(strict_types=1);

namespace CodelyTv\Backoffice\Auth\Application\Authenticate;

use CodelyTv\Shared\Domain\Bus\Command\Command;

final class AuthenticateUserCommand implements Command
{
    public function __construct(private readonly string $username, private readonly string $password)
    {
    }

    public function username(): string
    {
        return $this->username;
    }

    public function password(): string
    {
        return $this->password;
    }
}
