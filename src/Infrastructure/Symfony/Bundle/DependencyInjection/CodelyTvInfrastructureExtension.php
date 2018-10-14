<?php

namespace CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class CodelyTvInfrastructureExtension extends Extension
{
    public function load(array $config, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/Resources'));

        $loader->load('infrastructure_extension.yml');
        $loader->load(sprintf('infrastructure_config_%s.yml', $container->getParameter('kernel.environment')));
    }
}
