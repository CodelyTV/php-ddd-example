<?php

declare (strict_types = 1);

namespace CodelyTv\Infrastructure\Bus\Middleware;

use CodelyTv\Shared\Domain\Bus\Message;

interface Middleware
{
    public function __invoke(Message $message, callable $handler): ?callable;
}
