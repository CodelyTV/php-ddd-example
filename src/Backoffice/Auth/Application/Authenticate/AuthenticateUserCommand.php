<?php

declare(strict_types = 1);

namespace CodelyTv\Backoffice\Auth\Application\Authenticate;

use CodelyTv\Shared\Domain\Bus\Command\Command;

final class AuthenticateUserCommand implements Command
{
    private $username;
    private $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
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
