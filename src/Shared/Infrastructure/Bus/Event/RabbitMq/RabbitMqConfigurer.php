<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Infrastructure\Bus\Event\RabbitMq;

use AMQPQueue;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventSubscriber;

use function Lambdish\Phunctional\each;

final readonly class RabbitMqConfigurer
{
	public function __construct(private RabbitMqConnection $connection) {}

	public function configure(string $exchangeName, DomainEventSubscriber ...$subscribers): void
	{
		$retryExchangeName = RabbitMqExchangeNameFormatter::retry($exchangeName);
		$deadLetterExchangeName = RabbitMqExchangeNameFormatter::deadLetter($exchangeName);

		$this->declareExchange($exchangeName);
		$this->declareExchange($retryExchangeName);
		$this->declareExchange($deadLetterExchangeName);

		$this->declareQueues($exchangeName, $retryExchangeName, $deadLetterExchangeName, ...$subscribers);
	}

	private function declareExchange(string $exchangeName): void
	{
		$exchange = $this->connection->exchange($exchangeName);
		$exchange->setType(AMQP_EX_TYPE_TOPIC);
		$exchange->setFlags(AMQP_DURABLE);
		$exchange->declareExchange();
	}

	private function declareQueues(
		string $exchangeName,
		string $retryExchangeName,
		string $deadLetterExchangeName,
		DomainEventSubscriber ...$subscribers
	): void {
		each($this->queueDeclarator($exchangeName, $retryExchangeName, $deadLetterExchangeName), $subscribers);
	}

	private function queueDeclarator(
		string $exchangeName,
		string $retryExchangeName,
		string $deadLetterExchangeName
	): callable {
		return function (DomainEventSubscriber $subscriber) use (
			$exchangeName,
			$retryExchangeName,
			$deadLetterExchangeName
		): void {
			$queueName = RabbitMqQueueNameFormatter::format($subscriber);
			$retryQueueName = RabbitMqQueueNameFormatter::formatRetry($subscriber);
			$deadLetterQueueName = RabbitMqQueueNameFormatter::formatDeadLetter($subscriber);

			$queue = $this->declareQueue($queueName);
			$retryQueue = $this->declareQueue($retryQueueName, $exchangeName, $queueName, 1000);
			$deadLetterQueue = $this->declareQueue($deadLetterQueueName);

			$queue->bind($exchangeName, $queueName);
			$retryQueue->bind($retryExchangeName, $queueName);
			$deadLetterQueue->bind($deadLetterExchangeName, $queueName);

			foreach ($subscriber::subscribedTo() as $eventClass) {
				$queue->bind($exchangeName, $eventClass::eventName());
			}
		};
	}

	private function declareQueue(
		string $name,
		string $deadLetterExchange = null,
		string $deadLetterRoutingKey = null,
		int $messageTtl = null
	): AMQPQueue {
		$queue = $this->connection->queue($name);

		if ($deadLetterExchange !== null) {
			$queue->setArgument('x-dead-letter-exchange', $deadLetterExchange);
		}

		if ($deadLetterRoutingKey !== null) {
			$queue->setArgument('x-dead-letter-routing-key', $deadLetterRoutingKey);
		}

		if ($messageTtl !== null) {
			$queue->setArgument('x-message-ttl', $messageTtl);
		}

		$queue->setFlags(AMQP_DURABLE);
		$queue->declareQueue();

		return $queue;
	}
}
