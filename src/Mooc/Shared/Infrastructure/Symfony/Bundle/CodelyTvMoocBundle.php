<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Shared\Infrastructure\Symfony\Bundle;

use CodelyTv\Shared\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\DatabasesConnectionCompilerPass;
use CodelyTv\Shared\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\DomainEventSubscribersConfigurationCompilerPass;
use CodelyTv\Shared\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\TransactionalServiceCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class CodelyTvMoocBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new DomainEventSubscribersConfigurationCompilerPass('codely.mooc.subscriber'));
        $container->addCompilerPass(new DatabasesConnectionCompilerPass('codely.mooc.database'));
        $container->addCompilerPass(new TransactionalServiceCompilerPass('codely.mooc.domain_event_publisher'));
    }
}
