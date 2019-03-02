<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Uuid;

use Ramsey\Uuid\Uuid;

final class UuidGenerator
{
    public function next(): string
    {
        return Uuid::uuid4()->toString();
    }
}
