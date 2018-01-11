<?php

namespace CodelyTv\Shared\Domain\Bus\Command;

use CodelyTv\Shared\Domain\Bus\Request;
use CodelyTv\Types\ValueObject\Uuid;

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
