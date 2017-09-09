<?php

declare (strict_types = 1);

namespace CodelyTv\Infrastructure\Bus\Command;

use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Shared\Domain\Bus\Command\CommandBus;
use CodelyTv\Shared\Domain\Bus\MessageSerializer;
use function Lambdish\Phunctional\apply;

final class CommandBusAsync implements CommandBus
{
    private $pendingRequestsFilePath;

    public function __construct(string $pendingRequestsFilePath)
    {
        $this->pendingRequestsFilePath = $pendingRequestsFilePath;
    }

    public function register($commandClass, callable $handler)
    {
    }

    public function dispatch(Command $command)
    {
        file_put_contents($this->pendingRequestsFilePath, apply(new MessageSerializer(), [$command]));
    }
}
