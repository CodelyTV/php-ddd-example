<?php

declare (strict_types = 1);

namespace CodelyTv\Shared\Domain\Bus;

use CodelyTv\Types\ValueObject\Uuid;

abstract class Request extends Message
{
    public function requestId(): Uuid
    {
        return $this->messageId();
    }
}
