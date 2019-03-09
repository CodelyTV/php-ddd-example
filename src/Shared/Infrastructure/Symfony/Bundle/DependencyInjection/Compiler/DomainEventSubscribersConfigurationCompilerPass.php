<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler;

use CodelyTv\Shared\Infrastructure\Bus\Event\SubscribersMapping;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use function Lambdish\Phunctional\each;
use function Lambdish\Phunctional\get;
use function Lambdish\Phunctional\last;
use function Lambdish\Phunctional\map;
use CodelyTv\Shared\Infrastructure\Bus\Event\DomainEventSubscribersConfiguration;

final class DomainEventSubscribersConfigurationCompilerPass implements CompilerPassInterface
{
    public const DOMAIN_EVENT_CONFIGURATION_SERVICE = DomainEventSubscribersConfiguration::class;
    public const SUBSCRIBERS_MAPPING_SERVICE        = SubscribersMapping::class;
    private $tag;

    public function __construct(string $tag)
    {
        $this->tag = $tag;
    }

    public function process(ContainerBuilder $container): void
    {
        $domainEventConfiguration = $container->findDefinition(self::DOMAIN_EVENT_CONFIGURATION_SERVICE);
        $subscribersMapping       = $container->findDefinition(self::SUBSCRIBERS_MAPPING_SERVICE);
        $subscribersIds           = $container->findTaggedServiceIds($this->tag);

        each(
            $this->addSubscriberConfiguration($domainEventConfiguration, $subscribersMapping, $container),
            $subscribersIds
        );
    }

    private function addSubscriberConfiguration(
        Definition $domainEventConfiguration,
        Definition $subscribersMapping,
        ContainerBuilder $container
    ): callable {
        return function (
            array $attributes,
            string $subscriberServiceId
        ) use (
            $domainEventConfiguration,
            $subscribersMapping,
            $container
        ): void {
            $subscriber = $container->findDefinition($subscriberServiceId);

            $subscriberName  = $this->extractSubscriberName($subscriberServiceId);
            $subscriberClass = $subscriber->getClass();
            $events          = $subscriberClass::subscribedTo();

            $config = array_merge(
                get(0, $attributes, []),
                [
                    'name'              => $subscriberName,
                    'subscribed_events' => map($this->eventNameExtractor(), $events),
                ]
            );

            $domainEventConfiguration->addMethodCall('set', [$subscriberClass, $config]);
            $subscribersMapping->addMethodCall('add', [$subscriberName, new Reference($subscriberServiceId)]);
        };
    }

    private function extractSubscriberName(string $subscriberServiceId)
    {
        return last(explode('.', $subscriberServiceId));
    }

    private function eventNameExtractor(): callable
    {
        return function (string $eventClass) {
            return $eventClass::eventName();
        };
    }
}
