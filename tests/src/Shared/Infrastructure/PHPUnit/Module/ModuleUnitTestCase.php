<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Infrastructure\PHPUnit\Module;

use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Shared\Domain\Bus\Command\CommandBus;
use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventPublisher;
use CodelyTv\Shared\Domain\Bus\Query\Query;
use CodelyTv\Shared\Domain\Bus\Query\QueryBus;
use CodelyTv\Shared\Domain\Bus\Query\Response;
use CodelyTv\Test\Shared\Infrastructure\PHPUnit\UnitTestCase;
use Mockery\MockInterface;
use Psr\Log\LoggerInterface;
use function CodelyTv\Test\Shared\equalTo;
use function CodelyTv\Test\Shared\similarTo;
use function Lambdish\Phunctional\map;

abstract class ModuleUnitTestCase extends UnitTestCase
{
    private $domainEventPublisher;
    private $queryBus;
    private $commandBus;
    private $logger;

    /** @return QueryBus|MockInterface */
    protected function queryBus()
    {
        return $this->queryBus = $this->queryBus ?: $this->mock(QueryBus::class);
    }

    /** @return DomainEventPublisher|MockInterface */
    protected function domainEventPublisher()
    {
        return $this->domainEventPublisher = $this->domainEventPublisher ?: $this->mock(DomainEventPublisher::class);
    }

    /** @return CommandBus|MockInterface */
    protected function commandBus()
    {
        return $this->commandBus = $this->commandBus ?: $this->mock(CommandBus::class);
    }

    /** @return LoggerInterface|MockInterface */
    protected function logger()
    {
        return $this->logger = $this->logger ?: $this->mock(LoggerInterface::class);
    }

    protected function assertAskResponse(Query $query, Response $response, callable $handler): void
    {
        $this->assertEquals($response, $this->ask($query, $handler), 'QueryBus did not returned the expected response');
    }

    protected function assertAskNullResponse(Query $query, callable $handler): void
    {
        $this->assertNull($this->ask($query, $handler), 'QueryBus did not returned the expected response');
    }

    protected function assertAskThrowsException($exceptionClass, Query $query, callable $handler): void
    {
        $this->expectException($exceptionClass);

        $this->ask($query, $handler);
    }

    protected function shouldAsk(Query $query, Response $response = null): void
    {
        $this->queryBus()
            ->shouldReceive('ask')
            ->once()
            ->with(similarTo($query))
            ->andReturn($response);
    }

    protected function shouldAskThrowingException(Query $query, $exception): void
    {
        $this->queryBus()
            ->shouldReceive('ask')
            ->once()
            ->with(equalTo($query))
            ->andThrow($exception);
    }

    protected function notify(DomainEvent $event, callable $subscriber): void
    {
        $subscriber($event);
    }

    protected function shouldNotifyThrowingException(
        DomainEvent $event,
        callable $subscriber,
        string $exceptionClass
    ): void {
        $this->expectException($exceptionClass);

        $this->notify($event, $subscriber);
    }

    protected function dispatch(Command $command, callable $handler): void
    {
        $handler($command);
    }

    /** @param DomainEvent[] $events */
    protected function shouldPublishDomainEvents(DomainEvent ...$events): void
    {
        $this->domainEventPublisher()
            ->shouldReceive('publish')
            ->once()
            ->with(...map($this->addSimilarTo(), $events))
            ->andReturnNull();
    }

    protected function shouldNotPublishDomainEvents(): void
    {
        $this->domainEventPublisher()
            ->shouldNotReceive('publish');
    }

    protected function shouldLog($level): void
    {
        $this->logger()->shouldReceive($level)->once()->andReturnNull();
    }

    protected function shouldLogMessage($level, $message, array $context = []): void
    {
        $this->logger()
            ->shouldReceive($level)
            ->once()
            ->with($message, $context)
            ->andReturnNull();
    }

    private function ask(Query $query, callable $handler)
    {
        return $handler($query);
    }

    private function addSimilarTo(): callable
    {
        return function (DomainEvent $event) {
            return similarTo($event);
        };
    }
}
