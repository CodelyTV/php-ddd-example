<?php

namespace CodelyTv\Test\Behat;

use Behat\Behat\Context\Context;
use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Shared\Domain\Bus\Command\CommandBus;
use CodelyTv\Shared\Domain\Bus\Query\Query;
use CodelyTv\Shared\Domain\Bus\Query\QueryBus;
use function Lambdish\Phunctional\pipe;

abstract class BehatContext implements Context
{
    /** @var \CodelyTv\Shared\Domain\Bus\Command\CommandBus */
    private $commandBus;
    /** @var \CodelyTv\Shared\Domain\Bus\Query\QueryBus */
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
