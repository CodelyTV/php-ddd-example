<?php

declare(strict_types = 1);

namespace CodelyTv\Api\Command;

use CodelyTv\Infrastructure\Bus\Event\DomainEventSubscriberConfig;
use CodelyTv\Infrastructure\Bus\Event\DomainEventSubscribersConfiguration;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use function Lambdish\Phunctional\each;

final class GenerateSupervisorFilesCommand extends Command
{
    private const SUPERVISOR_PATH = __DIR__ . '/../../app/config/supervisor';

    private $configuration;

    public function __construct(DomainEventSubscribersConfiguration $configuration)
    {
        parent::__construct();

        $this->configuration = $configuration;
    }

    protected function configure()
    {
        $this
            ->setName('codelytv:domain-events:generate-supervisor-files')
            ->setDescription('Generate the supervisor configuration for every subscriber')
            ->addArgument('command-path', InputArgument::OPTIONAL, 'Path on this is gonna be deployed', '/var/www');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        each($this->configCreator($input->getArgument('command-path')), $this->configuration->all());
    }

    private function configCreator(string $path)
    {
        return function (DomainEventSubscriberConfig $config) use ($path) {
            $fileContent = str_replace(
                ['{subscriber}', '{path}', '{processes}', '{events_to_process}', '{enabled}'],
                [$config->name(), $path, $config->processes(), $config->eventsToProcess(), $config->enabledString()],
                $this->template()
            );

            file_put_contents($this->fileName($config->name()), $fileContent);
        };
    }

    private function template()
    {
        return <<<EOF
[program:codely_{subscriber}]
command      = {path}/applications/api/bin/console codelytv:domain-events:consume --env=prod {subscriber} {events_to_process}
process_name = %(program_name)s_%(process_num)02d
numprocs     = {processes}
startsecs    = 1
startretries = 10
exitcodes    = 2
stopwaitsecs = 300
autostart    = {enabled}
EOF;
    }

    private function fileName(string $queue)
    {
        return sprintf('%s/%s.ini', self::SUPERVISOR_PATH, $queue);
    }
}
