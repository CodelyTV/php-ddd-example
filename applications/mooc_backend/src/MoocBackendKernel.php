<?php

declare(strict_types = 1);

namespace CodelyTv\MoocBackend;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;
use function array_key_exists;
use function dirname;
use function Lambdish\Phunctional\filter;
use function Lambdish\Phunctional\map;

final class MoocBackendKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = require $this->getRootDir() . '/config/bundles.php';

        return map($this->instanciateBundle(), filter($this->hasToBeRemoved(), $bundles));
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
        $loader->load($this->getRootDir() . '/config/config_' . $this->getEnvironment() . '.yml');
    }

    public function getContainer()
    {
        $this->bootKernelInTestEnvironmentToDiscoverErrorsWhenDeveloping();

        return parent::getContainer();
    }

    private function bootKernelInTestEnvironmentToDiscoverErrorsWhenDeveloping(): void
    {
        if ('test' === $this->getEnvironment()) {
            $this->boot();
        }
    }

    public function getRootDir(): string
    {
        return dirname(__DIR__);
    }

    private function hasToBeRemoved(): callable
    {
        return function (array $environmentOptions) {
            if ('test' === $this->getEnvironment()) {
                return true;
            }

            return !array_key_exists('test', $environmentOptions);
        };
    }

    private function instanciateBundle(): callable
    {
        return function (array $unused, $class) {
            return new $class();
        };
    }
}
