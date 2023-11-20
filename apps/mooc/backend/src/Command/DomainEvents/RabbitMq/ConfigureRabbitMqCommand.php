<?php

declare(strict_types=1);

namespace CodelyTv\Apps\Mooc\Backend\Command\DomainEvents\RabbitMq;

use CodelyTv\Shared\Infrastructure\Bus\Event\RabbitMq\RabbitMqConfigurer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Traversable;

#[AsCommand(
	name: 'codely:domain-events:rabbitmq:configure',
	description: 'Configure the RabbitMQ to allow publish & consume domain events',
)]
final class ConfigureRabbitMqCommand extends Command
{
	public function __construct(
		private readonly RabbitMqConfigurer $configurer,
		private readonly string $exchangeName,
		private readonly Traversable $subscribers
	) {
		parent::__construct();
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$this->configurer->configure($this->exchangeName, ...iterator_to_array($this->subscribers));

		return 0;
	}
}
