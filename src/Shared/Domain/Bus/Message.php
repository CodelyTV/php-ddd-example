<?php

declare (strict_types = 1);

namespace CodelyTv\Shared\Domain\Bus;

use CodelyTv\Types\ValueObject\Uuid;

abstract class Message
{
    private $messageId;

    public function __construct(Uuid $messageId)
    {
        $this->messageId = $messageId;
    }

    public function messageId(): Uuid
    {
        return $this->messageId;
    }

    abstract public function messageType(): string;
}
