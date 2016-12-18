<?php

namespace CodelyTv\Api\Infrastructure\Controller;

use CodelyTv\Api\Infrastructure\Exception\ApiExceptionsHttpStatusCodeMapping;
use CodelyTv\Infrastructure\Bus\Command\Command;
use CodelyTv\Infrastructure\Bus\Command\CommandBus;
use CodelyTv\Infrastructure\Bus\Query\Oracle;
use CodelyTv\Infrastructure\Bus\Query\Query;
use function Lambdish\Phunctional\each;

abstract class ApiController
{
    private $oracle;
    private $commandBus;
    private $exceptionHandler;

    public function __construct(
        Oracle $oracle,
        CommandBus $commandBus,
        ApiExceptionsHttpStatusCodeMapping $exceptionHandler
    ) {
        $this->oracle           = $oracle;
        $this->commandBus       = $commandBus;
        $this->exceptionHandler = $exceptionHandler;

        each($this->exceptionRegistrar(), $this->exceptions());
    }

    abstract protected function exceptions() : array;

    protected function dispatch(Command $command)
    {
        $this->commandBus->dispatch($command);
    }

    protected function ask(Query $query)
    {
        return $this->oracle->ask($query);
    }

    private function exceptionRegistrar()
    {
        return function ($httpCode, $exception) {
            $this->exceptionHandler->register($exception, $httpCode);
        };
    }
}
