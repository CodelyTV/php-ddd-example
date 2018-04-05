<?php

declare(strict_types = 1);

namespace CodelyTv\Api\Command;

use CodelyTv\Infrastructure\Bus\Event\SubscribersMapping;
use CodelyTv\Infrastructure\Doctrine\DatabaseConnections;
use CodelyTv\Infrastructure\RabbitMQ\RabbitMQDomainEventConsumer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use function Lambdish\Phunctional\apply;
use function Lambdish\Phunctional\pipe;
use function Lambdish\Phunctional\repeat;

final class ConsumeDomainEventsCommand extends Command
{
    private $consumer;
    private $mapping;
    private $connections;

    public function __construct(
        RabbitMQDomainEventConsumer $consumer,
        SubscribersMapping $mapping,
        DatabaseConnections $connections
    ) {
        parent::__construct();

        $this->consumer    = $consumer;
        $this->mapping     = $mapping;
        $this->connections = $connections;
    }

    protected function configure()
    {
        $this
            ->setName('codelytv:domain-events:consume')
            ->setDescription('Consume domain events')
            ->addArgument('subscriber', InputArgument::REQUIRED, 'Subscriber to process')
            ->addArgument('quantity', InputArgument::REQUIRED, 'Quantity of events to process');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $subscriberName    = $input->getArgument('subscriber');
        $messagesToProcess = $input->getArgument('quantity');

        repeat(pipe($this->consume($subscriberName), $this->connections->allConnectionsClearer()), $messagesToProcess);
    }

    private function consume(string $subscriberName)
    {
        return function () use ($subscriberName) {
            apply($this->consumer, [$this->mapping->byName($subscriberName), $subscriberName]);
        };
    }
}
