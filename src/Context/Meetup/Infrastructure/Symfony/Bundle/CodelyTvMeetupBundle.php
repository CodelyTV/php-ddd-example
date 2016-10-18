<?php

namespace CodelyTv\Context\Meetup\Infrastructure\Symfony\Bundle;

use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\CommandBusCompilerPass;
use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\DomainEventPublisherCompilerPass;
use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\DomainEventSubscribersConfigurationCompilerPass;
use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\OracleCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CodelyTvMeetupBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new CommandBusCompilerPass('codely.meetup.command'));
        $container->addCompilerPass(new OracleCompilerPass('codely.meetup.query'));
        $container->addCompilerPass(new DomainEventPublisherCompilerPass('codely.meetup.subscriber'));
        $container->addCompilerPass(new DomainEventSubscribersConfigurationCompilerPass('codely.meetup.subscriber'));
    }
}
