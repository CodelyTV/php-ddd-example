<?php

declare(strict_types=1);

namespace CodelyTv\Apps\Mooc\Backend\Command\DomainEvents\RabbitMq;

use CodelyTv\Shared\Domain\Bus\Event\DomainEventSubscriber;
use CodelyTv\Shared\Infrastructure\Bus\Event\DomainEventSubscriberLocator;
use CodelyTv\Shared\Infrastructure\Bus\Event\RabbitMq\RabbitMqQueueNameFormatter;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function Lambdish\Phunctional\each;

#[AsCommand(
	name: 'codely:domain-events:rabbitmq:generate-supervisor-files',
	description: 'Generate the supervisor configuration for every RabbitMQ subscriber',
)]
final class GenerateSupervisorRabbitMqConsumerFilesCommand extends Command
{
	private const EVENTS_TO_PROCESS_AT_TIME = 200;
	private const NUMBERS_OF_PROCESSES_PER_SUBSCRIBER = 1;
	private const SUPERVISOR_PATH = __DIR__ . '/../../../../build/supervisor';

	public function __construct(private readonly DomainEventSubscriberLocator $locator)
	{
		parent::__construct();
	}

	protected function configure(): void
	{
		$this->addArgument('command-path', InputArgument::OPTIONAL, 'Path on this is gonna be deployed', '/var/www');
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$path = $input->getArgument('command-path');

		each($this->configCreator($path), $this->locator->all());

		return 0;
	}

	private function configCreator(string $path): callable
	{
		return function (DomainEventSubscriber $subscriber) use ($path): void {
			$queueName = RabbitMqQueueNameFormatter::format($subscriber);
			$subscriberName = RabbitMqQueueNameFormatter::shortFormat($subscriber);

			$fileContent = str_replace(
				['{subscriber_name}', '{queue_name}', '{path}', '{processes}', '{events_to_process}', ],
				[
					$subscriberName,
					$queueName,
					$path,
					self::NUMBERS_OF_PROCESSES_PER_SUBSCRIBER,
					self::EVENTS_TO_PROCESS_AT_TIME,
				],
				$this->template()
			);

			file_put_contents($this->fileName($subscriberName), $fileContent);
		};
	}

	private function template(): string
	{
		return <<<EOF
            [program:codelytv_{queue_name}]
            command      = {path}/apps/mooc/backend/bin/console codely:domain-events:rabbitmq:consume --env=prod {queue_name} {events_to_process}
            process_name = %(program_name)s_%(process_num)02d
            numprocs     = {processes}
            startsecs    = 1
            startretries = 10
            exitcodes    = 2
            stopwaitsecs = 300
            autostart    = true
            EOF;
	}

	private function fileName(string $queue): string
	{
		return sprintf('%s/%s.ini', self::SUPERVISOR_PATH, $queue);
	}
}
