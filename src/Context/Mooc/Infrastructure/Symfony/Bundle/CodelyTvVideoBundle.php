<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Mooc\Infrastructure\Symfony\Bundle;

use CodelyTv\Shared\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\DatabasesConnectionCompilerPass;
use CodelyTv\Shared\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\DomainEventSubscribersConfigurationCompilerPass;
use CodelyTv\Shared\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\TransactionalServiceCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class CodelyTvVideoBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new DomainEventSubscribersConfigurationCompilerPass('codely.mooc.subscriber'));
        $container->addCompilerPass(new DatabasesConnectionCompilerPass('codely.mooc.database'));
        $container->addCompilerPass(new TransactionalServiceCompilerPass('codely.mooc.domain_event_publisher'));
    }
}
