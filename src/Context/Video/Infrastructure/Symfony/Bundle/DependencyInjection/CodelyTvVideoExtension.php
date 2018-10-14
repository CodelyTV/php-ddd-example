<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Infrastructure\Symfony\Bundle\DependencyInjection;

use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventSubscriber;
use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

final class CodelyTvVideoExtension extends Extension
{
    public function load(array $config, ContainerBuilder $container)
    {
        $container->registerForAutoconfiguration(CommandHandler::class)->addTag('codely.video.command');
        $container->registerForAutoconfiguration(QueryHandler::class)->addTag('codely.video.query');
        $container->registerForAutoconfiguration(DomainEventSubscriber::class)->addTag('codely.video.subscriber');

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/Resources'));

        $loader->load('video_extension.yml');
        $loader->load(sprintf('video_config_%s.yml', $container->getParameter('kernel.environment')));
    }
}
