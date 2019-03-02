<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use function Lambdish\Phunctional\each;

final class TransactionalServiceCompilerPass implements CompilerPassInterface
{
    public const TRANSACTIONAL_TAG = 'transactional';
    public const BY_TAG            = 'by';
    private $domainEventPublisherTag;

    public function __construct(string $domainEventPublisherTag)
    {
        $this->domainEventPublisherTag = $domainEventPublisherTag;
    }

    public function process(ContainerBuilder $container): void
    {
        $servicesToBeTransactional = $container->findTaggedServiceIds(self::TRANSACTIONAL_TAG);

        each($this->serviceDecorator($container), $servicesToBeTransactional);
    }

    private function serviceDecorator(ContainerBuilder $container): callable
    {
        return function (array $tags, string $serviceToBeTransactional) use ($container): void {
            $this->ensureByTagExists($tags, $serviceToBeTransactional);

            $container->register($serviceToBeTransactional . '.transactional', TransactionalWrapper::class)
                ->addArgument(new Reference($tags[0][self::BY_TAG]))
                ->addArgument(new Reference($this->domainEventPublisherTag))
                ->addArgument(new Reference($serviceToBeTransactional . '.transactional.inner'))
                ->setDecoratedService($serviceToBeTransactional)
                ->setPublic(false);
        };
    }

    private function ensureByTagExists(array $tags, string $serviceToBeTransactional): void
    {
        if (!array_key_exists(self::BY_TAG, $tags[0])) {
            throw new TransactionalServiceByTagNotDefined($serviceToBeTransactional);
        }
    }
}
