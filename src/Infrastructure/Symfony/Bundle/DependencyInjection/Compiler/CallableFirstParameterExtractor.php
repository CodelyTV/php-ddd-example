<?php

declare(strict_types = 1);

namespace CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler;

use CodelyTv\Shared\Domain\Bus\Event\DomainEventSubscriber;
use ReflectionClass;
use ReflectionMethod;
use function Lambdish\Phunctional\reduce;
use function Lambdish\Phunctional\reindex;

final class CallableFirstParameterExtractor
{
    public function extract($class)
    {
        $reflector = new ReflectionClass($class);
        $method    = $reflector->getMethod('__invoke');

        if ($this->hasOnlyOneParameter($method)) {
            return $this->firstParameterClassFrom($method);
        }
    }

    public static function forCallables(iterable $callables): array
    {
        return reindex(self::classExtractor(new self()), $callables);
    }

    public static function forPipedCallables(iterable $callables): array
    {
        return reduce(self::pipedCallablesReducer(new self()), $callables);
    }

    private function firstParameterClassFrom(ReflectionMethod $method)
    {
        return $method->getParameters()[0]->getClass()->getName();
    }

    private function hasOnlyOneParameter(ReflectionMethod $method)
    {
        return $method->getNumberOfParameters() === 1;
    }

    private static function classExtractor(CallableFirstParameterExtractor $parameterExtractor)
    {
        return function (callable $handler) use ($parameterExtractor) {
            return $parameterExtractor->extract($handler);
        };
    }

    private static function pipedCallablesReducer(CallableFirstParameterExtractor $parameterExtractor)
    {
        return function ($subscribers, DomainEventSubscriber $subscriber) use ($parameterExtractor) {
            $subscribedEvents = $subscriber::subscribedTo();

            foreach ($subscribedEvents as $subscribedEvent) {
                $subscribers[$subscribedEvent][] = $subscriber;
            }

            return $subscribers;
        };
    }
}
