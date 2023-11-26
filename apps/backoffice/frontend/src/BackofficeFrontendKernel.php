<?php

declare(strict_types=1);

namespace CodelyTv\Apps\Backoffice\Frontend;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;

use function dirname;

class BackofficeFrontendKernel extends Kernel
{
	use MicroKernelTrait;

	private const CONFIG_EXTS = '.{xml,yaml}';

	public function registerBundles(): iterable
	{
		$contents = require $this->getProjectDir() . '/config/bundles.php';
		foreach ($contents as $class => $envs) {
			if ($envs[$this->environment] ?? $envs['all'] ?? false) {
				yield new $class();
			}
		}
	}

	public function getProjectDir(): string
	{
		return dirname(__DIR__);
	}

	protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader): void
	{
		$container->addResource(new FileResource($this->getProjectDir() . '/config/bundles.php'));
		$container->setParameter('.container.dumper.inline_class_loader', true);
		$confDir = $this->getProjectDir() . '/config';

		$loader->load($confDir . '/services' . self::CONFIG_EXTS, 'glob');
		$loader->load($confDir . '/services_' . $this->environment . self::CONFIG_EXTS, 'glob');
		$loader->load($confDir . '/services/*' . self::CONFIG_EXTS, 'glob');
	}
}
