<?php

namespace CodelyTv\Test\PhpUnit\TestCase\Module;

use CodelyTv\Infrastructure\Bus\Command\Command;
use CodelyTv\Infrastructure\Bus\Command\CommandBus;
use CodelyTv\Infrastructure\Bus\Event\DomainEvent;
use CodelyTv\Infrastructure\Bus\Event\DomainEventPublisher;
use CodelyTv\Infrastructure\Bus\Query\Oracle;
use CodelyTv\Infrastructure\Bus\Query\Query;
use CodelyTv\Infrastructure\Bus\Query\Response;
use CodelyTv\Test\PhpUnit\TestCase\UnitTestCase;
use Mockery\MockInterface;
use Psr\Log\LoggerInterface;
use function CodelyTv\Test\similarTo;

abstract class ModuleUnitTestCase extends UnitTestCase
{
    private $domainEventPublisher;
    private $oracle;
    private $commandBus;
    private $logger;

    /** @return Oracle|MockInterface */
    protected function oracle()
    {
        return $this->oracle = $this->oracle ?: $this->mock(Oracle::class);
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

    protected function assertAskResponse(Query $query, Response $response, callable $handler)
    {
        $this->assertEquals($response, $this->ask($query, $handler), 'Oracle did not returned the expected response');
    }

    protected function assertAskNullResponse(Query $query, callable $handler)
    {
        $this->assertNull($this->ask($query, $handler), 'Oracle did not returned the expected response');
    }

    protected function assertAskThrowsException($exceptionClass, Query $query, callable $handler)
    {
        $this->expectException($exceptionClass);

        $this->ask($query, $handler);
    }

    protected function shouldAskOracle(Query $query, Response $response = null)
    {
        $this->oracle()
            ->shouldReceive('ask')
            ->once()
            ->with(similarTo($query))
            ->andReturn($response);
    }

    protected function shouldAskOracleThrowingException(Query $query, $exception)
    {
        $this->oracle()
            ->shouldReceive('ask')
            ->once()
            ->with(equalTo($query))
            ->andThrow($exception);
    }

    protected function notify(DomainEvent $event, callable $subscriber)
    {
        $subscriber($event);
    }

    protected function shouldNotifyThrowingException(DomainEvent $event, callable $subscriber, string $exceptionClass)
    {
        $this->expectException($exceptionClass);

        $this->notify($event, $subscriber);
    }

    protected function dispatch(Command $command, callable $handler)
    {
        $handler($command);
    }

    /** @param DomainEvent[] $events */
    protected function shouldPublishDomainEvents(array $events)
    {
        $this->domainEventPublisher()
            ->shouldReceive('publish')
            ->once()
            ->with(similarTo($events))
            ->andReturnNull();
    }

    protected function shouldNotPublishDomainEvents()
    {
        $this->domainEventPublisher()
            ->shouldNotReceive('publish');
    }

    protected function shouldLog($level)
    {
        $this->logger()->shouldReceive($level)->once()->andReturnNull();
    }

    protected function shouldLogMessage($level, $message, array $context = [])
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
}
