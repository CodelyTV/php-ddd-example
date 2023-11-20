<?php

declare(strict_types=1);

namespace CodelyTv\Apps\Mooc\Backend\Command\DomainEvents\MySql;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Shared\Infrastructure\Bus\Event\DomainEventSubscriberLocator;
use CodelyTv\Shared\Infrastructure\Bus\Event\MySql\MySqlDoctrineDomainEventsConsumer;
use CodelyTv\Shared\Infrastructure\Doctrine\DatabaseConnections;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function Lambdish\Phunctional\pipe;

#[AsCommand(name: 'codely:domain-events:mysql:consume', description: 'Consume domain events from MySql',)]
final class ConsumeMySqlDomainEventsCommand extends Command
{
	public function __construct(
		private readonly MySqlDoctrineDomainEventsConsumer $consumer,
		private readonly DatabaseConnections $connections,
		private readonly DomainEventSubscriberLocator $subscriberLocator
	) {
		parent::__construct();
	}

	protected function configure(): void
	{
		$this->addArgument('quantity', InputArgument::REQUIRED, 'Quantity of events to process');
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$quantityEventsToProcess = (int) $input->getArgument('quantity');

		$consumer = pipe($this->consumer(), fn () => $this->connections->clear());

		$this->consumer->consume($consumer, $quantityEventsToProcess);

		return 0;
	}

	private function consumer(): callable
	{
		return function (DomainEvent $domainEvent): void {
			$subscribers = $this->subscriberLocator->allSubscribedTo($domainEvent::class);

			foreach ($subscribers as $subscriber) {
				$subscriber($domainEvent);
			}
		};
	}
}
