<?php

namespace CodelyTv\Test\Behat;

use Behat\Behat\Context\Context;
use CodelyTv\Infrastructure\Bus\Command\Command;
use CodelyTv\Infrastructure\Bus\Command\CommandBus;
use CodelyTv\Infrastructure\Bus\Query\Oracle;
use CodelyTv\Infrastructure\Bus\Query\Query;
use function Lambdish\Phunctional\pipe;

abstract class BehatContext implements Context
{
    /** @var CommandBus */
    private $commandBus;
    /** @var Oracle */
    private $oracle;

    protected function setCommandBus(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    protected function setOracle(Oracle $oracle)
    {
        $this->oracle = $oracle;
    }

    /** @return callable */
    protected function publisherOf(callable $commandCreator)
    {
        return pipe($commandCreator, $this->dispacher());
    }

    protected function dispacher()
    {
        return function (Command $command) {
            $this->commandBus->dispatch($command);

            return $command;
        };
    }

    protected function publish(Command $command)
    {
        $publisher = $this->dispacher();
        $publisher($command);
    }

    protected function asker()
    {
        return function (Query $query) {
            return $this->oracle->ask($query);
        };
    }

    protected function ask(Query $query)
    {
        $asker = $this->asker();

        return $asker($query);
    }
}
