<?php

namespace CodelyTv\Test\Behat;

use Behat\Behat\Context\Context;
use CodelyTv\Infrastructure\Bus\Command\Command;
use CodelyTv\Infrastructure\Bus\Command\CommandBus;
use CodelyTv\Infrastructure\Bus\Query\QueryBus;
use CodelyTv\Infrastructure\Bus\Query\Query;
use function Lambdish\Phunctional\pipe;

abstract class BehatContext implements Context
{
    /** @var CommandBus */
    private $commandBus;
    /** @var QueryBus */
    private $queryBus;

    protected function setCommandBus(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    protected function setQueryBus(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
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
            return $this->queryBus->ask($query);
        };
    }

    protected function ask(Query $query)
    {
        $asker = $this->asker();

        return $asker($query);
    }
}
