<?php

declare(strict_types = 1);

namespace CodelyTv\Infrastructure\RabbitMQ;

use CodelyTv\Infrastructure\Bus\Event\DomainEventMapping;
use CodelyTv\Shared\Application\DomainEventSubscriber;
use Exception;
use Psr\Log\LoggerInterface;

final class RabbitMQDomainEventConsumer
{
    private $connection;
    private $mapping;
    private $logger;

    public function __construct(RabbitMQConnection $connection, DomainEventMapping $mapping, LoggerInterface $logger)
    {
        $this->connection = $connection;
        $this->mapping    = $mapping;
        $this->logger     = $logger;
    }

    public function __invoke(callable $subscriber, string $name)
    {
        $queueName = RabbitMQQueueNameFormatter::format($name);
        $queue     = $this->queue($queueName);

        $queue->consume(
            new RabbitMQConsumer($subscriber, $this->mapping, $this->logger)
        );
    }

    private function queue(string $queueName)
    {
        try {
            return $this->connection->queue($queueName);
        } catch (Exception $exception) {
            $this->logger->error(
                'Domain Event consumption failed at opening a channel',
                ['queue' => $queueName, 'exception' => $exception]
            );

            throw new RabbitMQDomainEventConsumeConnectionFailed(
                'Domain Event consumption failed at opening a channel',
                $exception
            );
        }
    }
}
