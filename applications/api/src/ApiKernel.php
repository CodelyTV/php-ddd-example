<?php

namespace CodelyTv\Api;

use CodelyTv\Context\Video\Infrastructure\Symfony\Bundle\CodelyTvVideoBundle;
use CodelyTv\Infrastructure\Symfony\Bundle\CodelyTvInfrastructureBundle;
use FOS\RestBundle\FOSRestBundle;
use JMS\SerializerBundle\JMSSerializerBundle;
use Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\MonologBundle\MonologBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class ApiKernel extends Kernel
{
    public function registerBundles()
    {
        return [
            new CodelyTvInfrastructureBundle(),
            new CodelyTvVideoBundle(),

            new SensioFrameworkExtraBundle(),
            new FrameworkBundle(),
            new TwigBundle(),

            new MonologBundle(),

            new FOSRestBundle(),
            new JMSSerializerBundle(),
//            new NelmioApiDocBundle(),
        ];
    }

    public function getName()
    {
        return 'api';
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
