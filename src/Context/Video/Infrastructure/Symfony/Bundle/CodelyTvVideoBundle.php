<?php

namespace CodelyTv\Context\Video\Infrastructure\Symfony\Bundle;

use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\CommandBusCompilerPass;
use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\DomainEventPublisherCompilerPass;
use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\DomainEventSubscribersConfigurationCompilerPass;
use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\OracleCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CodelyTvVideoBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new CommandBusCompilerPass('codely.video.command'));
        $container->addCompilerPass(new OracleCompilerPass('codely.video.query'));
        $container->addCompilerPass(new DomainEventPublisherCompilerPass('codely.video.subscriber'));
        $container->addCompilerPass(new DomainEventSubscribersConfigurationCompilerPass('codely.video.subscriber'));
    }
}
