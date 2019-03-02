<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Infrastructure\Arranger;

interface EnvironmentArranger
{
    /**
     * Clean all the infrastructure required and arrange all the needed stuff
     */
    public function arrange(): void;

    /**
     * Close all the infrastructure connections
     */
    public function close(): void;
}
