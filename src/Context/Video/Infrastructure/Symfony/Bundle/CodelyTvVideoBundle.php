<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Infrastructure\Symfony\Bundle;

use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\DatabasesConnectionCompilerPass;
use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\DomainEventSubscribersConfigurationCompilerPass;
use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\TransactionalServiceCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class CodelyTvVideoBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new DomainEventSubscribersConfigurationCompilerPass('codely.video.subscriber'));
        $container->addCompilerPass(new DatabasesConnectionCompilerPass('codely.video.database'));
        $container->addCompilerPass(new TransactionalServiceCompilerPass('codely.video.domain_event_publisher'));
    }
}
