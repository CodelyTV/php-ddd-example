<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Infrastructure\Bus;

use CodelyTv\Shared\Domain\Bus\Event\DomainEventSubscriber;
use LogicException;
use ReflectionClass;
use ReflectionMethod;
use ReflectionNamedType;

use function Lambdish\Phunctional\map;
use function Lambdish\Phunctional\reduce;
use function Lambdish\Phunctional\reindex;

final class CallableFirstParameterExtractor
{
	public static function forCallables(iterable $callables): array
	{
		return map(self::unflatten(), reindex(self::classExtractor(new self()), $callables));
	}

	public static function forPipedCallables(iterable $callables): array
	{
		return reduce(self::pipedCallablesReducer(), $callables, []);
	}

	private static function classExtractor(self $parameterExtractor): callable
	{
		return static fn (object $handler): ?string => $parameterExtractor->extract($handler);
	}

	private static function pipedCallablesReducer(): callable
	{
		return static function (array $subscribers, DomainEventSubscriber $subscriber): array {
			$subscribedEvents = $subscriber::subscribedTo();

			foreach ($subscribedEvents as $subscribedEvent) {
				$subscribers[$subscribedEvent][] = $subscriber;
			}

			return $subscribers;
		};
	}

	private static function unflatten(): callable
	{
		return static fn (mixed $value): array => [$value];
	}

	public function extract(object $class): ?string
	{
		$reflector = new ReflectionClass($class);
		$method = $reflector->getMethod('__invoke');

		if ($this->hasOnlyOneParameter($method)) {
			return $this->firstParameterClassFrom($method);
		}

		return null;
	}

	private function firstParameterClassFrom(ReflectionMethod $method): string
	{
		/** @var ReflectionNamedType|null $fistParameterType */
		$fistParameterType = $method->getParameters()[0]->getType();

		if ($fistParameterType === null) {
			throw new LogicException('Missing type hint for the first parameter of __invoke');
		}

		return $fistParameterType->getName();
	}

	private function hasOnlyOneParameter(ReflectionMethod $method): bool
	{
		return $method->getNumberOfParameters() === 1;
	}
}
