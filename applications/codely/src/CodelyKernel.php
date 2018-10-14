<?php

namespace CodelyTv;

use CodelyTv\Context\Video\Infrastructure\Symfony\Bundle\CodelyTvVideoBundle;
use CodelyTv\Infrastructure\Symfony\Bundle\CodelyTvInfrastructureBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\MonologBundle\MonologBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class CodelyKernel extends Kernel
{
    public function registerBundles()
    {
        return [
            new FrameworkBundle(),

            new MonologBundle(),

            new CodelyTvInfrastructureBundle(),
            new CodelyTvVideoBundle(),
        ];
    }

    public function getName()
    {
        return 'codely';
    }

    public function getRootDir()
    {
        return realpath(__DIR__ . '/..');
    }

    public function getCacheDir()
    {
        return $this->getRootDir() . '/var/cache';
    }

    public function getLogDir()
    {
        return $this->getRootDir() . '/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir() . '/app/config/config_' . $this->getEnvironment() . '.yml');
    }

    public function getContainer()
    {
        $this->bootKernelInTestEnvironmentToDiscoverErrorsWhenDeveloping();

        return parent::getContainer();
    }

    private function bootKernelInTestEnvironmentToDiscoverErrorsWhenDeveloping()
    {
        if ($this->getEnvironment() === 'test') {
            $this->boot();
        }
    }
}
