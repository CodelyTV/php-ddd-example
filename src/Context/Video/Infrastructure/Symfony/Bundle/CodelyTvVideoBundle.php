<?php

namespace CodelyTv\Context\Video\Infrastructure\Symfony\Bundle;

use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\CommandBusCompilerPass;
use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\DatabasesConnectionCompilerPass;
use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\DomainEventPublisherCompilerPass;
use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\DomainEventSubscribersConfigurationCompilerPass;
use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\QueryBusCompilerPass;
use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\TransactionalServiceCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CodelyTvVideoBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new CommandBusCompilerPass('codely.video.command'));
        $container->addCompilerPass(new QueryBusCompilerPass('codely.video.query'));
        $container->addCompilerPass(new DomainEventPublisherCompilerPass('codely.video.subscriber'));
        $container->addCompilerPass(new DomainEventSubscribersConfigurationCompilerPass('codely.video.subscriber'));
        $container->addCompilerPass(new DatabasesConnectionCompilerPass('codely.video.database'));
        $container->addCompilerPass(new TransactionalServiceCompilerPass('codely.video.domain_event_publisher'));
    }
}
