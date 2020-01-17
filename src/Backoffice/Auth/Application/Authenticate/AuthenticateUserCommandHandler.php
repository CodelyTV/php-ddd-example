<?php

declare(strict_types = 1);

namespace CodelyTv\Backoffice\Auth\Application\Authenticate;

use CodelyTv\Backoffice\Auth\Domain\AuthPassword;
use CodelyTv\Backoffice\Auth\Domain\AuthUsername;
use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;

final class AuthenticateUserCommandHandler implements CommandHandler
{
    private $authenticator;

    public function __construct(UserAuthenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    public function __invoke(AuthenticateUserCommand $command)
    {
        $username = new AuthUsername($command->username());
        $password = new AuthPassword($command->password());

        $this->authenticator->authenticate($username, $password);
    }
}
