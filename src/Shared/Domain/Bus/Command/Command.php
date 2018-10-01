<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Domain\Bus\Command;

use CodelyTv\Shared\Domain\Bus\Request;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

abstract class Command extends Request
{
    public function commandId(): Uuid
    {
        return $this->requestId();
    }

    public function messageType(): string
    {
        return 'command';
    }
}
