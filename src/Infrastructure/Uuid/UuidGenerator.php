<?php

namespace CodelyTv\Infrastructure\Uuid;

use Rhumsaa\Uuid\Uuid;

final class UuidGenerator
{
    public function next()
    {
        return Uuid::uuid4()->toString();
    }
}
