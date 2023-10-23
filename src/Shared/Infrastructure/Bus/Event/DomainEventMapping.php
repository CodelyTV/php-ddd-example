<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Infrastructure\Bus\Event;

use CodelyTv\Shared\Domain\Bus\Event\DomainEventSubscriber;
use RuntimeException;

use function Lambdish\Phunctional\reduce;
use function Lambdish\Phunctional\reindex;

final class DomainEventMapping
{
	private array $mapping;

	public function __construct(iterable $mapping)
	{
		$this->mapping = reduce($this->eventsExtractor(), $mapping, []);
	}

	public function for(string $name): string
	{
		if (!isset($this->mapping[$name])) {
			throw new RuntimeException("The Domain Event Class for <$name> doesn't exists or have no subscribers");
		}

		return $this->mapping[$name];
	}

	private function eventsExtractor(): callable
	{
		return fn (array $mapping, DomainEventSubscriber $subscriber): array => array_merge(
			$mapping,
			reindex($this->eventNameExtractor(), $subscriber::subscribedTo())
		);
	}

	private function eventNameExtractor(): callable
	{
		return static fn (string $eventClass): string => $eventClass::eventName();
	}
}
