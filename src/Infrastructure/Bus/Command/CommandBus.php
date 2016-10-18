<?php

namespace CodelyTv\Infrastructure\Bus\Command;

use RuntimeException;

interface CommandBus
{
    /**
     * @throws RuntimeException
     *
     * @return void
     */
    public function register($commandClass, callable $handler);

    /** @return void */
    public function dispatch(Command $command);
}
