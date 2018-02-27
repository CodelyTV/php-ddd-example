<?php

namespace CodelyTv\Test\Infrastructure\Arranger;

interface EnvironmentArranger
{
    /**
     * Clean all the infrastructure required and arrange all the needed stuff
     *
     * @return void
     */
    public function arrange();

    /**
     * Close all the infrastructure connections
     *
     * @return void
     */
    public function close();
}
