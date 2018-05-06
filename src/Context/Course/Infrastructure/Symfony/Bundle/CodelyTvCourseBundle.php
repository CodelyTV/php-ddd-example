<?php

namespace CodelyTv\Context\Course\Infrastructure\Symfony\Bundle;

use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\CommandBusCompilerPass;
use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\DatabasesConnectionCompilerPass;
use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\DomainEventPublisherCompilerPass;
use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\DomainEventSubscribersConfigurationCompilerPass;
use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\QueryBusCompilerPass;
use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\TransactionalServiceCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CodelyTvCourseBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new CommandBusCompilerPass('codely.course.command'));
        $container->addCompilerPass(new QueryBusCompilerPass('codely.course.query'));
        $container->addCompilerPass(new DomainEventPublisherCompilerPass('codely.course.subscriber'));
        $container->addCompilerPass(new DomainEventSubscribersConfigurationCompilerPass('codely.course.subscriber'));
        $container->addCompilerPass(new DatabasesConnectionCompilerPass('codely.course.database'));
        $container->addCompilerPass(new TransactionalServiceCompilerPass('codely.course.domain_event_publisher'));
    }
}
