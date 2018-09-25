<?php

namespace CodelyTv\Infrastructure\Bus\Query;

use CodelyTv\Shared\Domain\Bus\Query\Query;
use CodelyTv\Shared\Domain\Bus\Query\QueryBus;
use RuntimeException;
use Symfony\Component\Messenger\Handler\Locator\HandlerLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

final class SymfonySyncQueryBus implements QueryBus
{
    private $queryToHandler = [];
    private $bus;
    private $askHasBeenCalled = false;

    public function register($queryClass, callable $handler)
    {
        $this->guardAskHasNotBeenCalled();

        $this->queryToHandler[$queryClass] = $handler;
    }

    public function ask(Query $query)
    {
        $this->markAsAsked();

        return $this->bus()->dispatch($query);
    }

    private function guardAskHasNotBeenCalled()
    {
        if ($this->askHasBeenCalled) {
            throw new RuntimeException('Trying to register a new handler after some query has been asked');
        }
    }

    private function markAsAsked()
    {
        if (!$this->askHasBeenCalled) {
            $this->askHasBeenCalled = true;
        }
    }

    private function bus(): MessageBus
    {
        return $this->bus = $this->bus ?: new MessageBus(
            [
                new HandleMessageMiddleware(new HandlerLocator($this->queryToHandler)),
            ]
        );
    }
}
