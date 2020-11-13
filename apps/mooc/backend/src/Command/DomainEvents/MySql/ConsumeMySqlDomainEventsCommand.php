<?php

declare(strict_types=1);

namespace CodelyTv\Apps\Mooc\Backend\Command\DomainEvents\MySql;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Shared\Infrastructure\Bus\Event\DomainEventSubscriberLocator;
use CodelyTv\Shared\Infrastructure\Bus\Event\MySql\MySqlDoctrineDomainEventsConsumer;
use CodelyTv\Shared\Infrastructure\Doctrine\DatabaseConnections;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use function Lambdish\Phunctional\pipe;

final class ConsumeMySqlDomainEventsCommand extends Command
{
    protected static $defaultName = 'codelytv:domain-events:mysql:consume';

    public function __construct(
        private MySqlDoctrineDomainEventsConsumer $consumer,
        private DatabaseConnections $connections,
        private DomainEventSubscriberLocator $subscriberLocator
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Consume domain events from MySql')
            ->addArgument('quantity', InputArgument::REQUIRED, 'Quantity of events to process');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $quantityEventsToProcess = (int) $input->getArgument('quantity');

        $consumer = pipe($this->consumer(), fn() => $this->connections->clear());

        $this->consumer->consume($consumer, $quantityEventsToProcess);

        return 0;
    }

    private function consumer(): callable
    {
        return function (DomainEvent $domainEvent) {
            $subscribers = $this->subscriberLocator->allSubscribedTo(get_class($domainEvent));

            foreach ($subscribers as $subscriber) {
                $subscriber($domainEvent);
            }
        };
    }
}
