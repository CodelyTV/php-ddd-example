<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Bus\Event\Serialize;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Shared\Infrastructure\Bus\Event\DomainEventMapping;
use function CodelyTv\Utils\Shared\snake_to_camel;
use function Lambdish\Phunctional\get;
use function Lambdish\Phunctional\reindex;

final class DomainEventUnserializer
{
    private $eventMapping;

    public function __construct(DomainEventMapping $eventMapping)
    {
        $this->eventMapping = $eventMapping;
    }

    public function __invoke(string $serializedEvent): DomainEvent
    {
        $parsedEvent = json_decode($serializedEvent, true);

        $eventName  = $parsedEvent['type'];
        $eventClass = $this->eventMapping->for($eventName);

        return new $eventClass(get('id', $parsedEvent), reindex($this->toCamel(), $parsedEvent));
    }

    private function toCamel(): callable
    {
        return function ($unused, $key): string {
            return snake_to_camel($key);
        };
    }
}
