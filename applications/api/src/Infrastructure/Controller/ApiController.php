<?php

namespace CodelyTv\Api\Infrastructure\Controller;

use CodelyTv\Api\Infrastructure\Exception\ApiExceptionsHttpStatusCodeMapping;
use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Shared\Domain\Bus\Command\CommandBus;
use CodelyTv\Shared\Domain\Bus\Query\Query;
use CodelyTv\Shared\Domain\Bus\Query\QueryBus;
use function Lambdish\Phunctional\each;

abstract class ApiController
{
    private $queryBus;
    private $commandBus;
    private $exceptionHandler;

    public function __construct(
        QueryBus $queryBus,
        CommandBus $commandBus,
        ApiExceptionsHttpStatusCodeMapping $exceptionHandler
    ) {
        $this->queryBus         = $queryBus;
        $this->commandBus       = $commandBus;
        $this->exceptionHandler = $exceptionHandler;

        each($this->exceptionRegistrar(), $this->exceptions());
    }

    abstract protected function exceptions(): array;

    protected function dispatch(Command $command)
    {
        $this->commandBus->dispatch($command);
    }

    protected function ask(Query $query)
    {
        return $this->queryBus->ask($query);
    }

    private function exceptionRegistrar()
    {
        return function ($httpCode, $exception) {
            $this->exceptionHandler->register($exception, $httpCode);
        };
    }
}
