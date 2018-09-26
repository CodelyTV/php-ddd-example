<?php

namespace CodelyTv\Infrastructure\Uuid;

use Ramsey\Uuid\Uuid;

final class UuidGenerator
{
    public function next()
    {
        return Uuid::uuid4()->toString();
    }
}
