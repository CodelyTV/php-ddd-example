<?php

declare (strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Bus\Command;

use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Shared\Domain\Bus\Command\CommandBus;
use CodelyTv\Shared\Domain\Bus\MessageSerializer;
use function Lambdish\Phunctional\apply;

class CommandBusAsync implements CommandBus
{
    private $pendingRequestsFilePath;

    public function __construct(string $pendingRequestsFilePath)
    {
        $this->pendingRequestsFilePath = $pendingRequestsFilePath;
    }

    public function dispatch(Command $command): void
    {
        file_put_contents($this->pendingRequestsFilePath, apply(new MessageSerializer(), [$command]));
    }
}
