<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Shared\Infrastructure\Symfony\Bundle\DependencyInjection;

use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventSubscriber;
use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

final class CodelyTvMoocExtension extends Extension
{
    public function load(array $config, ContainerBuilder $container): void
    {
        $container->registerForAutoconfiguration(CommandHandler::class)->addTag('codely.mooc.command');
        $container->registerForAutoconfiguration(QueryHandler::class)->addTag('codely.mooc.query');
        $container->registerForAutoconfiguration(DomainEventSubscriber::class)->addTag('codely.mooc.subscriber');

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/Resources'));

        $loader->load('mooc_extension.yml');
        $loader->load(sprintf('mooc_config_%s.yml', $container->getParameter('kernel.environment')));
    }
}
