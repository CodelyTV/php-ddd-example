<?php

declare(strict_types = 1);

namespace CodelyTv\Infrastructure\RabbitMQ;

use AMQPChannel;
use AMQPConnection;
use AMQPQueue;
use Psr\Log\LoggerInterface;

final class RabbitMQConnection
{
    /** @var AMQPConnection */
    private static $connection;
    /** @var AMQPChannel */
    private static $channel;
    /** @var AMQPQueue[] */
    private static $queues = [];
    private $configuration;
    private $logger;

    public function __construct(array $configuration, LoggerInterface $logger)
    {
        $this->configuration = $configuration;
        $this->logger        = $logger;
    }

    public function queue(string $name): AMQPQueue
    {
        if (!array_key_exists($name, self::$queues)) {
            $queue = new AMQPQueue($this->channel());
            $queue->setName($name);

            self::$queues[$name] = $queue;
        }

        return self::$queues[$name];
    }

    public function queueBinder(AMQPQueue $queue): callable
    {
        return function (string $exchange, string $routingKey) use ($queue) {
            $queue->bind($exchange, $routingKey);
        };
    }

    private function channel(): AMQPChannel
    {
        return self::$channel =
            self::$channel && self::$channel->isConnected() ? self::$channel : new AMQPChannel($this->connection());
    }

    private function connection(): AMQPConnection
    {
        self::$connection = self::$connection ?: new AMQPConnection($this->configuration);
        self::$connection->isConnected() ?: self::$connection->pconnect();

        return self::$connection;
    }
}
