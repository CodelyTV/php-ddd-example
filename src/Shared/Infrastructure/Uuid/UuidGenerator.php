<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Uuid;

use Ramsey\Uuid\Uuid;

final class UuidGenerator
{
    public function next()
    {
        return Uuid::uuid4()->toString();
    }
}
